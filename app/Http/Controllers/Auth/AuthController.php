<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Code;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $student_id = 'student_id';

    // protected $loginView = 'frontend.welcome';

    public $code_id;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
     protected function validator(array $data)
     {
         $validate = Validator::make($data, [
             'name' => 'required|max:255',
             'email' => 'required|email|max:255|unique:users',
             'password' => 'required|min:6|confirmed',
             'address' => 'required|min:6',
             'phonenumber' => 'required|min:11|numeric',
             'student_id' => 'required|min:8|unique:users',
             'level_id' => 'required|numeric',
             'specialization_id' => 'required|numeric',
             'code' => 'required',
         ]);

         // NOTE get the First 2 string For the student id
         $student_id = substr($data['student_id'], 0, 2);

         // NOTE Make The Allowed id form [Start With 19 OR 20]
         $allowedFormate = ['19', '20'];

         if (!in_array($student_id, $allowedFormate)) {
             $validate->after(function($validate){
                 $validate->errors()->add('student_id', 'the student id field must start with year from 1993 till ' . date('Y'));
             });

         }


         $code = Code::where('code', $data['code'])->first();
         $stid = Code::where('student_id', $data['student_id'])->first();

         if ($code) {
             if ($stid) {
                 if ($code->student_id == $stid->student_id) {
                     $this->code_id = $code->id;
                     return $validate;
                 }else {
                     $validate->after(function($validate){
                         $validate->errors()->add('code', 'The Code You Entered Exsist But The Student ID Dosent Belong To It');
                     });
                 }
             }else {
                 $validate->after(function($validate){
                     $validate->errors()->add('code', 'The StudentID You Entered Dose Not Exsist');
                 });
             }
         }else {
             $validate->after(function($validate){
                 $validate->errors()->add('code', 'The Code You Entered Dose Not Exsist');
             });
         }


         return $validate;
     }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      $user =  User::create([
         'name' => $data['name'],
         'email' => $data['email'],
         'password' => bcrypt($data['password']),
         'address' => $data['address'],
         'phonenumber' => $data['phonenumber'],
         'student_id' => $data['student_id'],
         'type' => 1,
         'level_id' => $data['level_id'],
         'specialization_id' => $data['specialization_id'],
         'code_id' => $this->code_id,
      ]);


      return $user;
   }
}
