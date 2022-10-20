<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepositAgenciesResource;
use App\Models\Customer;
use App\Models\DepositAgency;
use Dingo\Api\Routing\Helpers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use Helpers;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(){
        //we dont need it because we did it in the route
        // $this->middleware('auth.jwt',['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(){
        $credentials = request(['email','password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'],401);
        }


        $data['user']  = auth()->user();
        $data['token'] = $token;

        return response()->json([
            'access_token' => $data,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
        ]);
        //return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     * @authenticated
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(){
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function guard(){
        return Auth::guard('api');
    }

    /**
     * Refresh a token.
     *fgajsdgfajsdhfgasjhdfgasjdf
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(){
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     *  register
     * [دالة التسجيل  .]
     * @bodyParam  first_name string required ['required','string','max:255'],
     * @bodyParam last_name string required ['required','string','max:255'],
     * @bodyParam email  string required 'required|string|email|max:255',
     * @bodyParam  password  string required  ['required','string','min:6','confirmed'],
     * @group Account
     * @return \Dingo\Api\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request){
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $login_data  = $this->guard()->login($user);
        $user->token = $login_data;

        return $this->response->array(['status' => 'true','data' => $user,'message' => 'success registration']);
    }

    protected function create(array $data){
        $customerCreated = Customer::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'phone'         => !empty($data['phone'])? $data['phone'] :null,
            'whatsapp_acc'  => isset($data['whatsapp_acc'])? $data['whatsapp_acc'] :null,
            'facebook_acc'  => isset($data['facebook_acc'])? $data['facebook_acc'] :null,
            'customer_type' => isset($data['customer_type'])? $data['customer_type'] :'customer',
            'country_code'  => isset($data['countries'])? $data['countries'] :null,
        ]);
        if (isset($data['countries'])) {
            $nationalAgencies = DepositAgency::
            where('national','national')
                ->select('id','name')
                ->get();
            $nationalAgencies = DepositAgenciesResource::collection($nationalAgencies);
            // $nationalAgencies = $nationalAgencies->pluck('id');
            foreach ($nationalAgencies as $oneAgency) {
                $customerCreated->financeAccounts()->create([
                    'customer_id'        => $customerCreated->id,
                    'agency_name'        => $oneAgency->name,
                    'agency_id' => $oneAgency->id,
                ]);
            }
        }

        return $customerCreated;
    }

    /**
     * Get the token array structure.
     *
     * @param  string  $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        return Validator::make($data,[
            'first_name' => ['required','string','max:255'],
            'last_name'  => ['required','string','max:255'],
            'email'      => 'required|string|email|max:255|unique:customers,email',
            'password'   => ['required','string','min:6','confirmed'],
        ]);
    }

}
