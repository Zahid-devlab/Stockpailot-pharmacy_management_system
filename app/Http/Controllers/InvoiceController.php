<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InvoiceController extends Controller
{

    function salePage()
    {

        $user_id = session()->get('userId');
        $user = User::where('id', $user_id)->first();
        $customers = Customer::where('user_id', $user_id)->orderBy('updated_at', 'desc')->get();

        $products = Product::where('user_id', $user_id)->where('unit', '>', 0)->orderBy('updated_at', 'desc')->get();

        return Inertia::render('sale/sale',['customers' => $customers, 'products' => $products])->with('user', $user);
    }
    function invoicePage(){
       $user_id = session()->get('userId');
        $user = User::where('id', $user_id)->first();
        $invoiceList = Invoice::where('user_id', $user_id)->with('customer')->orderBy('updated_at', 'desc')->get();
        return Inertia::render('invoice/invoice', ['list' => $invoiceList])->with('user', $user);
    }
    function invoiceCreate(Request $request) {


        DB::beginTransaction();
        try {
            $request->validate([
                'total' => 'required',
                'vat' => 'required',
                'payable' => 'required',
                'customer_id' => 'required',
                'products' => 'required'
            ]);

            $user_id = $request->session()->get('userId');

            $total = $request->input('total');
            $discount = $request->input('discount');
            $vat = $request->input('vat');
            $payable = $request->input('payable');
            $customer_id = $request->input('customer_id');
            $due = $request->input('due');

            // dd($due);

            $invoice = Invoice::create([
                'total' => $total,
                'discount' => $request->input('discount')?:0,
                'vat' => $vat,
                'payable' => $payable,
                'user_id' => $user_id,
                'customer_id' => $customer_id,
                'due' => $due,
            ]);

            $invoice_id = $invoice->id;
            $products = $request->input('products');


            foreach ($products as $product) {

                $buyPrice = Product::where('id', $product['product_id'])
                    ->where('user_id', $user_id)
                    ->value('price');
                // dd($buyPrice);

                InvoiceProduct::create([
                    'invoice_id' => $invoice_id,
                    'user_id' => $user_id,
                    'product_id' => $product['product_id'],
                    'qty' => $product['qty'],
                    'sale_price' => $product['sale_price'],
                    'buy_price' => $buyPrice,

                ]);

                Product::where('id', $product['product_id'])->where('user_id', $user_id)->decrement('unit', $product['qty']);
            }

             DB::commit();

            return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Invoice created successfully']);

        } catch (Exception $e) {
             DB::rollBack();

            return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }
    }


    function invoiceSelect(Request $request, $id) {
        $user_id = $request->session()->get('userId');
        $user = User::where('id', $user_id)->first();
        $invoice = Invoice::where('id', $id)->where('user_id', $user_id)->with('customer')->first();
        $invoiceProduct = invoiceProduct::where('invoice_id', $id)->with('product')->get();

        $list = array(
            'invoice' => $invoice,
            'product' => $invoiceProduct
        );
        return Inertia::render('invoice/invoiceDetails', ['list' => $list])->with('user', $user);
    }

    function invoiceDetails(Request $request) {
       try {

        $request->validate([
            'customer_id' => 'required',
            'invoice_id' => 'required'
        ]);
        $user_id = $request->session()->get('userId');

        $customer_id = $request->input('customer_id');
        $invoice_id = $request->input('invoice_id');

        $customerDetails = Customer::where('user_id', $user_id)->where('id', $customer_id)->first();

        $invoiceTotal = Invoice::where('user_id', $user_id)->where('id', $invoice_id)->first();

        $invoiceProduct = invoiceProduct::where('user_id', $user_id)->where('invoice_id', $invoice_id)->with('product')->get();

        return array(
            'customer' => $customerDetails,
            'invoice' => $invoiceTotal,
            'product' => $invoiceProduct
        );


       }catch(Exception $e) {
           return response()->json([
               'status' => 404,
               'message' => $e->getMessage(),
           ]);
       }
    }

    function invoiceDelete(Request $request) {

        DB::beginTransaction();
        try {

            $user_id = $request->session()->get('userId');
            $invoice_id = $request->input('invoice_id');
            invoiceProduct::where('invoice_id', $invoice_id)->where('user_id', $user_id)->delete();
            Invoice::where('id', $invoice_id)->where('user_id', $user_id)->delete();

            DB::commit();

            return redirect()->back()->with('success', ['status' => 'success', 'message' => 'Invoice deleted successfully']);

        }catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', ['status' => 'error', 'message' => $e->getMessage()]);
        }



    }

    function editDues(Request $request) {
        $user_id = $request->session()->get('userId');
        $invoice_id = $request->input('invoice_id');
        $due = $request->input('due');
        Invoice::where('id', $invoice_id)->where('user_id', $user_id)->update(['due' => $due]);
        return redirect()->route('invoice')->with('success', ['status' => 'success', 'message' => 'Dues updated successfully']);
    }

}
