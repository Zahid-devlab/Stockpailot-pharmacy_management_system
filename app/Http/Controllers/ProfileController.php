<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Pest\Laravel\delete;

class ProfileController extends Controller
{
    public function profilePage(){

        $user_id = session()->get('userId');
        $user = User::where('id', $user_id)->first();
        $list = User::where('id', $user_id)->get();

        return Inertia::render('profile/profile', ['list' => $list])->with('user', $user);
    }

    function userUpdateProfile(Request $request){

        try{

            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'password' => 'required',
            ]);

            $firstName = $request->input('firstName');
            $lastName = $request->input('lastName');
            $email = $request->input('email');
            $mobile = $request->input('mobile');
            $password = $request->input('password');
            $password = bcrypt($password);
            $img = $request->file('img');



            $user = User::where('id', $request->session()->get('userId'))->first();

            if($user){


                if($img){
                    $img_old = $request->input('img_old');

                    if ($img_old) {
                        // Correct the delete method
                        $img_path = public_path($img_old);
                        if (file_exists($img_path)) {
                            unlink($img_path);
                        }
                    }

                    $file = $img;
                    $img_name = time() . $firstName . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/user'), $img_name);
                    $img_path = 'uploads/user/' . $img_name;

                    User::where('id', $user->id)->update([
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'email' => $email,
                        'mobile' => $mobile,
                        'password' => $password,
                        'img' => $img_path
                    ]);

                }else{
                   User::where('id', $user->id)->update([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email,
                    'mobile' => $mobile,
                    'password' => $password
                ]);
                }




                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'profile update successfully']);
            }else{
                return redirect()->back()->with('error', ['status' => 'error', 'message' => 'profile update failed']);
            }

        }catch(Exception $e){

            return redirect()->back()->with('error', ['status' => 'error', 'message' => 'Something went wrong']);
        }
    }
}
