<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Traits\VerificationTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepositAgenciesResource;
use App\Models\Customer;
use App\Models\DepositAgency;
use App\Models\Referrer;
use App\Providers\RouteServiceProvider;
use App\Rules\PhoneCountryRule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::User_PROFILE;
   
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:customers,email',
            'phone'      => ['nullable', 'max:20', new PhoneCountryRule(request()->phone, request()->countries)],
            'password'   => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     *
     * @return \App\Models\Customer
     */
    protected function create(array $data) {
        $customerCreated = Customer::create([
            'first_name'     => $data['first_name'],
            'last_name'      => $data['last_name'],
            'email'          => $data['email'],
            'password'       => Hash::make($data['password']),
            'phone'          => !empty($data['phone']) ? $data['phone'] : null,
            'whatsapp_acc'   => isset($data['whatsapp_acc']) ? $data['whatsapp_acc'] : null,
            'facebook_acc'   => isset($data['facebook_acc']) ? $data['facebook_acc'] : null,
            'customer_type'  => isset($data['customer_type']) ? $data['customer_type'] : 'customer',
            'country_code'   => isset($data['countries']) ? $data['countries'] : null,
            'email_token'    => md5(microtime().mt_rand()),
            'verified_email' => 0,
            'referrer_id'    => $this->getReferrer_id(),
            'reference_id'   => getTrx().substr(time(),-6),
        ]);
        if (isset($data['countries'])) {
            /*  $nationalAgencies = DepositAgency::
              where('national','national')
                  ->select('id','name')
                  ->get();
              $nationalAgencies = DepositAgenciesResource::collection($nationalAgencies);
              foreach ($nationalAgencies as $oneAgency) {
                  $customerCreated->financeAccounts()->create([
                      'customer_id'        => $customerCreated->id,
                      'agency_name'        => $oneAgency->name,
                      'agency_id' => $oneAgency->id,
                  ]);
              }*/
        }

        return $customerCreated;
    }

    
    public function register(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {

            if(User::where('email', $request->email)->first() != null){

                flash(translate('Email or Phone already exists.'));
                return back();
            }
        }

        elseif (User::where('phone', '+'.$request->country_code.$request->phone)->first() != null) {
            flash(translate('Phone already exists.'));
            return back();
        }

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        if($user->email != null){

            if(BusinessSetting::where('type', 'email_verification')->first()->value != 1){
                
                $user->email_verified_at = date('Y-m-d H:m:s');
                $user->save();
                flash(translate('Registration successfull.'))->success();
            }
            else {
                event(new Registered($user));
                flash(translate('Registration successfull. Please verify your email.'))->success();
            }
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());

    }


    public function getReferrer_id() {
        $referrer = Referrer::where('session_id', session()->getId())
            ->where('ip_address', request()->ip())->first('referrer_id');

        return $referrer ? $referrer->referrer_id : null;
        
    }   

    protected function registered(Request $request, $user)
    {
        if ($user->email == null) {
            return redirect()->route('verification');
        }
        else {
            return redirect()->route('home');
        }
    }


}
