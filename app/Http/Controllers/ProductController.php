<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InvoiceProduct;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class ProductController extends Controller
{

    public function productPage()
    {


        $user_id = session()->get('userId');

        $user = User::where('id', $user_id)->first();

        $list = Product::where('user_id', $user_id)->orderBy('updated_at', 'desc')->with('invoiceProduct')->get();

        $categoriesList = Category::where('user_id', $user_id)->get();


        return Inertia::render('product/products', ['list' => $list, 'categoriesList' => $categoriesList])->with('user', $user);
    }
    function productEditPage(Request $request, $id)
    {


        $id = $request->id;

        $product = Product::where('id', $id)->first();
        $categoriesList = Category::where('user_id', $product->user_id)->get();

        return Inertia::render('product/productEdit', ['product' => $product, 'categoriesList' => $categoriesList])->with('user', $product->user_id);
    }
    function userProductCreate(Request $request)
    {

        try {

            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'unit' => 'required',
                'category_id' => 'required',
            ]);

            $name = $request->input('name');
            $price = $request->input('price');
            $unit = $request->input('unit');
            $img = $request->input('img');
            $category_id = $request->input('category_id');

            $user = $request->session()->get('userId');

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $img_name = time() . $name . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/productImg'), $img_name);

                $img = 'uploads/productImg/' . $img_name;

                $product = Product::create([
                    'name' => $name,
                    'price' => $price,
                    'unit' => $unit,
                    'img_url' => $img,
                    'category_id' => $category_id,
                    'user_id' => $user,
                ]);

                if ($product) {
                    return back()->with('success', ['status' => 'success', 'message' => 'Product created successfully']);
                } else {
                    return back()->with('error', ['status' => 'error', 'message' => 'Product not created']);
                }
            } else {

                $product = Product::create([
                    'name' => $name,
                    'price' => $price,
                    'unit' => $unit,
                    'img_url' => $img,
                    'category_id' => $category_id,
                    'user_id' => $user,
                ]);

                return back()->with('success', ['status' => 'success', 'message' => 'Product created successfully']);
            }
        } catch (Exception $e) {
            return back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function userProductList(Request $request)
    {

        try {
            $products = Product::all();
            return response()->json(['message' => 'Product list', 'products' => $products], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function userProductDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'img_url' => 'required'
            ]);
            $user_id = $request->session()->get('userId');
            $product_id = $request->input('id');
            $filePath = $request->input('img_url');

            $filePath = public_path($filePath);




            $deletedRows = Product::where('id', $product_id)
                ->where('user_id', $user_id)
                ->delete();

            if (File::exists($filePath)) {
                File::delete($filePath);
            } else {
                return back()->with('error', ['status' => 'error', 'message' => 'File not found']);
            }

            if ($deletedRows > 0) {
                return back()->with('success', ['status' => 'success', 'message' => 'Product deleted successfully']);
            } else {
                return back()->with('error', ['status' => 'error', 'message' => 'Product not deleted']);
            }
        } catch (Exception $e) {

            return back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function userProductUpdate(Request $request)
    {


        try {

            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'unit' => 'required',
                'id' => 'required',
                'category_id' => 'required',

            ]);

            $user_id = $request->session()->get('userId');
            $product_id = $request->input('id');
            $name = $request->input('name');
            $price = $request->input('price');
            $unit = $request->input('unit');
            $oldImg = $request->input('old_file_url');
            $category_id = $request->input('category_id');


            if ($request->hasFile('img')) {

                $file = $request->file('img');

                $t = time();
                $file_name = time() . $name . '.' . $file->getClientOriginalExtension();

                $img_url = "uploads/productImg/{$file_name}";

                $file->move(public_path('uploads/productImg'), $file_name);

                $oldImg = $request->input('old_file_url');

                File::delete($oldImg);

                Product::where('id', $product_id)
                    ->where('user_id', $user_id)
                    ->update([
                        'name' => $name,
                        'price' => $price,
                        'unit' => $unit,
                        'img_url' => $img_url,
                        'category_id' => $category_id
                    ]);

                return redirect()->route('products')->with('success', ['status' => 'success', 'message' => 'Product updated successfully']);
            } else {
                Product::where('id', $product_id)
                    ->where('user_id', $user_id)
                    ->update([
                        'name' => $request->input('name'),
                        'price' => $request->input('price'),
                        'unit' => $request->input('unit'),
                        'category_id' => $request->input('category_id')
                    ]);

                return redirect()->route('products')->with('success', ['status' => 'success', 'message' => 'Product updated successfully']);
            }
        } catch (Exception $e) {
            return back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    function userProductById(Request $request)
    {

        try {
            $user_id = $request->session()->get('userId');
            $product_id = $request->input('id');
            $product = Product::where('id', $product_id)->where('user_id', $user_id)->first();
            return response()->json(['message' => 'Product found', 'product' => $product], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
