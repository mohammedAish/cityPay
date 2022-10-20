<?php

namespace App\Http\Controllers\Auth;

use App\CustomerCode;
use App\Events\CustomerWasLoged;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ValidateConfirmationRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Notifications\SendConfirmationNotification;
use App\Providers\RouteServiceProvider;
use App\RecordActivity;
use App\Wallet\Msegat;
use Backpack\PermissionManager\app\Models\Permission;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    // If not logged in redirect to
    protected $loginPath = 'login';

    // The maximum number of attempts to allow
    protected $maxAttempts = 5;

    // The number of minutes to throttle for
    protected $decayMinutes = 15;

    // After you've logged in redirect to
    //@todo create account page  Deprecated
    //protected $redirectTo = 'account';

    // After you've logged out redirect to
    protected $redirectAfterLogout = '/';
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = 'wallet/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  $this->middleware('guest:customers')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $countries = Country::whereActive(1)->get()->pluck('name', 'id');

//        return view('auth.UserLogin')->with('countries',$countries);
        return view('auth.newlogin')->with('countries', $countries);
    }

    /**
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Get the right login field
        // $loginField = getLoginField($request->input('email'));
        $loginField = 'email';

        // Get credentials values
        $credentials = [
            $loginField => $request->input($loginField),
            'password'  => $request->input('password'),
            'blocked'   => 0,
        ];
        if (in_array($loginField, ['email', 'phone'])) {
            $credentials['verified_' . $loginField] = 1;
        } else {
            $credentials['verified_email'] = 1;
            $credentials['verified_phone'] = 1;
        }

        // Auth the User
        if (Auth::guard('customers')->attempt($request->only('email', 'password'),
            $request->filled('remember'))) {

            $user = Customer::find(auth('customers')->user()->getAuthIdentifier());
            if (is_null($user->ip_address) || empty($user->ip_address)) {
                Customer::query()->where('id', $user->id)->update(['ip_address' => getUserIP()]);
//                $user->update(['ip_address' => getUserIP()]);
            }
            // Update last user logged Date
            Event::dispatch(new CustomerWasLoged($user));
            RecordActivity::query()->create([
                'type'        => 1,
                'key'         => 'i_logged_into_wallet_key',
                'customer_id' => $user->id,
            ]);


            return redirect()->intended($this->redirectTo);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        // Check and retrieve previous URL to show the login error on it.
        if (session()->has('url.intended')) {
            $this->loginPath = session()->get('url.intended');
        }
        return $this->sendFailedLoginResponse($request);

        // return redirect($this->loginPath)->withErrors(['error' => trans('auth.failed')])->withInput();
    }

    public function check_user_login(CheckLoginRequest $request)
    {
        $user = Customer::query()->where('email', $request->get('user_email'))->first();
        if ($user && Hash::check($request->get('user_password'), $user->password)) {

            RecordActivity::query()->create([
                'type'        => 1,
                'key'         => 'i_logged_into_wallet_key',
                'customer_id' => $user->id,
            ]);

            $require_verification_code = false;
            if (($user->ip_address != getUserIP()) && ($user->confirmation_notification == 2)) {
                $require_verification_code = true;
            }

            if ($user->confirmation_notification == 1) {
                $require_verification_code = true;
            }

            $confirmation_method = $user->confirmation_method;

            if ($require_verification_code) {
                if ($confirmation_method == 0) {
//                $confirmation_method = 'email';
                    //send using email
                    $code = random_int(100000, 999999);
                    CustomerCode::query()->create([
                        'code'        => $code,
                        'type'        => 'confirmation_notification_code',
                        'customer_id' => $user->id,
                    ]);
                    $user->notify(new SendConfirmationNotification($code));
                } else {
//                $confirmation_method = 'sms';
                    //send using SMS messages
//                    Msegat::sendSMS();
                }
            }

            return response()->json([
                'success'                   => true,
                'message'                   => cp('code_sent_successfully'),
                'require_verification_code' => $require_verification_code,
                'confirmation_method'       => $confirmation_method,
            ]);
        }

        $this->incrementLoginAttempts($request);

        if (session()->has('url.intended')) {
            $this->loginPath = session()->get('url.intended');
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function resend_verifiaction_code(Request $request)
    {
        $user = Customer::query()->where('email', $request->get('user_email', ''))->first();
        if ($user) {
            $code = random_int(100000, 999999);
            CustomerCode::query()->create([
                'code'        => $code,
                'type'        => 'confirmation_notification_code',
                'customer_id' => $user->id,
            ]);
            $user->notify(new SendConfirmationNotification($code));

            return response()->json([
                'success' => true,
                'message' => cp('code_resent_successfully'),
            ]);
        }
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customers');
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {

        RecordActivity::query()->create([
            'type'        => 2,
            'key'         => 'logout_from_wallet_key',
            'customer_id' => \auth('customers')->id(),
        ]);

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutLara(Request $request)
    {
        // Get the current Country
        if (session()->has('country_code')) {
            $countryCode = session('country_code');
        }
        if (session()->has('allowMeFromReferrer')) {
            $allowMeFromReferrer = session('allowMeFromReferrer');
        }

        // Remove all session vars
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        // Retrieve the current Country
        if (isset($countryCode) && !empty($countryCode)) {
            session()->put('country_code', $countryCode);
        }
        if (isset($allowMeFromReferrer) && !empty($allowMeFromReferrer)) {
            session()->put('allowMeFromReferrer', $allowMeFromReferrer);
        }

        $message = t('You have been logged out') . ' ' . t('See you soon');
        flash($message)->success();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    public function validateConfirmation(ValidateConfirmationRequest $request)
    {
        try {
            $confirmation_method = $request->get('confirmation_method', '');
            $verification_code = $request->get('verification_code', '');


            $user = Customer::query()->where('email', $request->get('guest_email'))->first();
            if ($user && Hash::check($request->get('guest_password'), $user->password)) {
                if ($confirmation_method == 0) {
                    $last_code = CustomerCode::query()
                        ->where('customer_id', $user->id)
                        ->where('type', 'confirmation_notification_code')->latest()->first();
                    if ($last_code && $last_code->code == $verification_code) {
                        $response = [
                            'success' => true,
                            'message' => cp('verified_successfully'),
                        ];
                    } else {
                        $response = [
                            'success' => false,
                            'message' => cp('wrong_verification_code'),
                        ];
                    }
                } elseif ($confirmation_method == 1) {
                    $response = [
                        'success' => true,
                        'message' => cp('verified_successfully'),
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => cp('unsupported_method'),
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => cp('not_found'),
                ];
            }

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($response);
    }
}
