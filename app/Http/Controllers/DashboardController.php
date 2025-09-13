<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{

    function dashboardPage( Request $request) {

        $user_id = $request->session()->get('userId');

        $user = User::where('id', $user_id)->first();
        $customer = Customer::where('user_id', $user_id)->count();
        $category = Category::where('user_id', $user_id)->count();
        $product = Product::where('user_id', $user_id)->count();
        $invoice = Invoice::where('user_id', $user_id)->count();
        $total = Invoice::where('user_id', $user_id)->sum('total');
        $due = Invoice::where('user_id', $user_id)->sum('due');

        $totalProfit = DB::table('invoice_products')
        ->where('user_id', $user_id)
        ->selectRaw('SUM((sale_price - buy_price) * qty) as total_profit')
        ->value('total_profit');

         

        $today = Carbon::today();

        $todayTotalSell = Invoice::where('user_id', $user_id)
        ->whereDate('created_at', $today)
        ->sum('total');

        $todayTotalProfit = DB::table('invoice_products')
        ->join('invoices', 'invoice_products.invoice_id', '=', 'invoices.id')
        ->where('invoice_products.user_id', $user_id)
        ->whereDate('invoices.created_at', $today)
        ->selectRaw('SUM((sale_price - buy_price) * qty) as profit')
        ->value('profit');

        $todayDue = Invoice::where('user_id', $user_id)
        ->whereDate('created_at', Carbon::today())
        ->sum('due');
        

        $list = [
            'customer' => $customer,
            'category' => $category,
            'product' => $product,
            'invoice' => $invoice,
            'total' => round($total, 2),
            'due' => round($due, 2),
            'totalProfit' => round($totalProfit, 2),
            'todayTotalSell' => round($todayTotalSell, 2),
            'todayTotalProfit' => round($todayTotalProfit, 2),
            'todayDue'=> $todayDue,
        ];

        return Inertia::render('userDashboard', $list)->with('user', $user);
    }



}
