<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

use App\Gamer;
use App\GamerMeta;
use App\Mail\VerifyEmailAddress;

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
    protected $redirectTo = '/home';

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
            //'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:gamers',
            'password' => 'required|string|min:6|confirmed',
            'alias' => 'required|string|min:1|max:25|unique:gamers',
            'fname' =>  'required|alpha_dash|min:1|max:25',
            'lname' =>  'required|alpha_dash|min:1|max:25',
            'dob' =>  'required|date',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $gamer =  Gamer::create([

            'email' => $data['email'],
            'password' => bcrypt($data['password']),

            'alias' =>  $data['alias'],
            'fname' =>  $data['fname'],
            'lname' =>  $data['lname'],
            'dob'   =>  $data['dob'],
            'status'=>  'unverified',

            'steamid'     =>  $data['steamid'],
            'battlenetid' =>  $data['battlenetid'],
            'discordid'   =>  $data['discordid'],
        ]);

        $metaVerify = new GamerMeta();

        $metaVerify->meta_key = 'email_verification_code';
        $metaVerify->meta_value = uniqid();

        $gamer->meta()->save($metaVerify);
        $email = new VerifyEmailAddress($data['email'], $metaVerify->meta_value);

        Mail::to($data['email'])->send($email);

        return $gamer;

    }
}
