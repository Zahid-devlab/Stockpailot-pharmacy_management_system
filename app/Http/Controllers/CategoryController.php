<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    function categoryPage(Request $request){
        $userId = $request->session()->get('userId');

        $user = User::where('id', $userId)->first();
        $list = Category::where('user_id', $userId)->orderby('updated_at', 'desc')->with('product')->get();

        return Inertia::render('category/category',['list' => $list])->with('user', $user);
    }



    function userCategoryCreate(Request $request) {


        try{

            $request->validate([
                'name' => 'required'
            ]);

            $name = $request->input('name');
            $user_id = $request->session()->get('userId');

            if($user_id) {
                $category = Category::create([
                    'name' => $name,
                    'user_id' => $user_id
                ]);

                if($category) {

                    return back()->with('success',['status' => 'success', 'message' => 'Category created successfully']);
                }else {
                    return back()->with('error',['status' => 'error', 'message' => 'Category not created']);
                }
            }else{
                return back()->with('error',['status' => 'error', 'message' => 'Something went wrong']);
            }




        }catch(Exception $e){
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ]);
        }


    }

    function userCategoryList(Request $request) {

        try{
            $category = Category::all();
            return response()->json([
                'status' => 200,
                'message' => 'Category list',
                'data' => $category
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ]);
        }
    }

    function userCategoryUpdate(Request $request) {

        try{
            $request->validate([
                'name' => 'required'
            ]);

            $id = $request->id;
            $name = $request->input('name');

            $category = Category::where('id', $id)->update([
                'name' => $name
            ]);

            if($category) {
                return back()->with('success',['status' => 'success', 'message' => 'Updated successfully']);
            }else {
                return back()->with('error',['status' => 'error', 'message' => 'Category not updated']);
            }

        }catch(Exception $e){
            return back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    function userCategoryDelete(Request $request) {

        try{

            $id = $request->id;

            $category = Category::where('id', $id)->delete();

            if($category) {
                return back()->with('success',['status' => 'success', 'message' => 'Category deleted successfully']);
            }else {
                return back()->with('error',['status' => 'error', 'message' => 'Category not deleted']);
            }

        }catch(Exception $e){
            return back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function userCategoryById(Request $request) {

        try{

            $id = $request->id;

            $category = Category::where('id', $id)->first();

            if($category) {
                return back()->with('success',['status' => 'success', 'category' => $category]);
            }else {
                return back()->with('error',['status' => 'error', 'message' => 'Category not found']);
            }

        }catch(Exception $e){
            return back()->with('error',['status' => 'error', 'message' => $e->getMessage()]);
        }
    }









}
