<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{


    function loginPage(){
        return Inertia::render('auth/login');
    }

    function registrationPage(){
        return Inertia::render('auth/registration');
    }


    function userRegistration(Request $request){

        try{

            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required | email | unique:users',
                'mobile' => 'required | unique:users',
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
            ]);

            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $mobile = $request->input('mobile');
            $password = $request->input('password');
            $password = bcrypt($password);

            $user = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'mobile' => $mobile,
                'password' => $password,
                // 'password' => bcrypt($password),
            ]);

            if($user){
                $data  = [
                    'status' => 'success',
                    'message' => 'Registration successfully'
                ];

                return redirect()->route('login')->with('success', $data);
            }else{
                $data  = [
                    'status' => 'failed',
                    'message' => 'Registration failed'
                ];
                return redirect()->back()->with('error', $data);
            }

        }catch(Exception $e){
            $data  = [
                'status' => 'failed',
                'message' => "Something went wrong"
            ];
            return redirect()->back()->with('error', $data);
        }

    }

    function userLogin(Request $request){
       try{


            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $email = $request->input('email');
            $password = $request->input('password');


            $user = User::where('email', $email)->first();

            if($user){

                if($user && Hash::check($password, $user->password)){

                     $request->session()->put('userId', $user->id);

                     $data  = [
                        'status' => 'success',
                        'message' => 'user login successfully'
                    ];

                    return redirect()->route('dashboard')->with('success', $data);

                }else{

                    $data  = [
                        'status' => 'failed',
                        'message' => 'password not matched'
                    ];

                    return redirect()->back()->with('error', $data);
                }
            }else{
                $data  = [
                    'status' => 'failed',
                    'message' => 'User not found'
                ];

                return redirect()->back()->with('error', $data);
            }


       }catch(Exception $e){

        $data  = [
            'status' => 'failed',
            'message' => 'Something went wrong'
        ];

        return redirect()->back()->with('error', $data);

       }
    }

    function userLogout(Request $request){

        $request->session()->flush();

        $test = $request->session()->get('user_id');


        return redirect()->route('login');
    }

    function userSendOtp(Request $request){

        try{

            $request->validate([
                'email' => 'required',
            ]);

            $email = $request->input('email');

            $user = User::where('email', $email)->first();

            if($user){
                $otp = rand(1000,9999);

                User::where('email', $user->email)->update([
                    'otp' => $otp
                ]);

                $request->session()->put('userEmail', $user->email);



                return response()->json([
                    'status' => 200,
                    'message' => '4 digit OTP sent successfully to your email',
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'User not matched',
                ]);
            }

        }catch(Exception $e){

            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ]);
        }
    }

    function userVerifyOtp(Request $request){

        try{

            $request->validate([
                'otp' => 'required',
            ]);

            $email = $request->session()->get('userEmail');

            $otp = $request->input('otp');

            $user = User::where('email', $email)->where('otp', $otp)->first();

            if($user){
                return response()->json([
                    'status' => 200,
                    'message' => 'OTP verified successfully',
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'OTP not matched',
                ]);
            }


        }catch(Exception $e){
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ]);
        }


    }

    function userResetPassword(Request $request){

        try{

            $request->validate([
                'password' => 'required',
                'cpassword' => 'required|same:password',
            ]);

            $email = $request->session()->get('userEmail');
            $password = $request->input('password');

            $user = User::where('email', $email)->first();

            if($user){
                User::where('email', $user->email)->update([
                    'password' => $password,
                ]);

                $request->session()->forget('userEmail');

                return response()->json([
                    'status' => 200,
                    'message' => 'Password reset successfully',
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'something went wrong',
                ]);
            }

        }catch(Exception $e){

            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ]);
        }
    }



}
