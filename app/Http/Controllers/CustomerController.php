<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    function customerPage(){
        $user_id = session()->get('userId');
        $user = User::where('id', $user_id)->first();
        $customers = Customer::where('user_id', $user_id)->with('invoice')->orderBy('updated_at', 'desc')->get();



        return Inertia::render('customer/customer', ['list' => $customers])->with('user', $user);

    }

    function customerCreatePage(){
        $user_id = session()->get('userId');
        $user = User::where('id', $user_id)->first();

        return Inertia::render('customer/customerCreate')->with('user', $user);
    }
    function userCustomerCreate(Request $request)
    {
        try{

            $request->validate([
                'name' => 'required',
                'email' => 'nullable',
                'mobile' => 'required',

            ]);

            $name = $request->input('name');
            $email = $request->input('email');
            $mobile = $request->input('mobile');

            $user_id = $request->session()->get('userId');

            if($user_id) {
                 Customer::create([
                    'name' => $name,
                    'email' => $email,
                    'mobile' => $mobile,
                    'user_id' => $user_id,
                ]);

                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Customer created successfully']);

            }else{
                return redirect()->back()->with('error', ['status' => 'error', 'message' => 'Something went wrong']);
            }

        }catch(Exception $e){
            return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function userCustomerList(Request $request)
    {
        try{
            $customers = Customer::all();
            return response()->json(['message' => 'Customer list', 'customers' => $customers], 200);
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }


    function customerEditPage(Request $request){

        $id = $request->id;

        $user_id = session()->get('userId');

        $user = User::where('id', $user_id)->first();

        $customer = Customer::where('id', $id)->where('user_id', $user_id)->first();

        return Inertia::render('customer/customerEdit', ['customer' => $customer])->with('user', $user);


    }
    function userCustomerUpdate(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required',
            ]);

            $id = $request->input('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $mobile = $request->input('mobile');

            $customer = Customer::find($id);

            if($customer){
                $customer->name = $name;
                $customer->email = $email;
                $customer->mobile = $mobile;
                $customer->save();

                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Customer updated successfully']);
            }else{
                return redirect()->back()->with('error', ['status' => 'error', 'message' => 'Customer not found']);
            }

        }catch(Exception $e){
            return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function userCustomerDelete(Request $request)
    {
        try{
            $id = $request->id;
            $customer = Customer::find($id);

            if($customer){
                $customer->delete();
                return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Customer deleted successfully']);
            }else{
                return redirect()->back()->with('error', ['status' => 'error', 'message' => 'Customer not found']);
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function userCustomerById(Request $request)
    {
        try{
            $id = $request->input('id');
            $customer = Customer::find($id);

            if($customer){
                return response()->json(['message' => 'Customer found', 'customer' => $customer], 200);
            }else{
                return response()->json(['message' => 'Customer not found'], 404);
            }
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }






}
