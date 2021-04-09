<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\BusinessSetting;
use App\OtpConfiguration;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPVerificationController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cookie;
use Nexmo;
use Twilio\Rest\Client;
use Session;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'mobile' => 'required|string|max:10|min:10|unique:users,mobile',
            'verification_code' => 'required|string|max:255',
            // 'dob' => 'required|date',
            
        ]);
    }
    // $rules = array(
    //     'Email' => 'required_without:QQ',
    //     'QQ' => 'required_without:Email',
    // );

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    { 
        $data = $request->all();
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
                'name' => $data['name'],
                // 'phone' => $data['phone'],
                'mobile' => $data['mobile'],
                'dob' => $data['dob'],
                'email' => $data['email'],
                // 'verification_code' => $data['verification_code'],
                'password' => Hash::make($data['password']),
            ]);
            

            $customer = new Customer;
            $customer->user_id = $user->id;
            // dd('test');
            // dd($user);
            // dd($request->get('verification_code'));
            // dd()
            if($request->get('verification_code')==Session::get('OTP')){
            $customer->save();
            }
            if(BusinessSetting::where('type', 'email_verification')->first()->value != 1){
                $user->email_verified_at = date('Y-m-d H:m:s');
                $user->save();
                flash(__('Registration successfull.'))->success();
            }
            else {
                $user->sendEmailVerificationNotification();
                flash(__('Registration successfull. Please verify your email.'))->success();
            }
        }
        else {
            if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated){
                $user = User::create([
                    'name' => $data['name'],
                    'mobile' => '+'.$data['country_code'].$data['mobile'],
                    'password' => Hash::make($data['password']),
                    'verification_code' => rand(100000, 999999)
                ]);

                $customer = new Customer;
                $customer->user_id = $user->id;
                $customer->save();
                
                if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated){
                    $otpController = new OTPVerificationController;
                    $otpController->send_code($user);
                }
            }
        }

        if(Cookie::has('referral_code')){
            $referral_code = Cookie::get('referral_code');
            $referred_by_user = User::where('referral_code', $referral_code)->first();
            if($referred_by_user != null){
                $user->referred_by = $referred_by_user->id;
                $user->save();
            }
        }

        return $user;
    }

    public function register(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->email)->first() != null){
                flash('Email already exists.');
                return back();
            }
        }
        elseif (User::where('mobile', '+'.$request->country_code.$request->mobile)->first() != null) {
            flash('Mobile already exists.');
            return back();
        }

        $this->validator($request->all())->validate();
        
    // dd($request->get('verification_code'));
    if(request()->get('verification_code')== Session::get('OTP')){
        event(new Registered($user = $this->create($request)));

        $this->guard()->login($user);
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
 
        redirect($this->redirectPath());
    } else {
        flash("OTP code doesnt match");
        return back();

    }
// dd('ghgh');

        
        
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
