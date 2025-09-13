<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    function reportPage(){
        $userId = session()->get('userId');
        $user = User::where('id', $userId)->first();
        return Inertia::render('report/report')->with('user', $user);
    }

    function saleReport(Request $request, $from, $to){
        $userId = $request->session()->get('userId');

        $from = date('Y-m-d', strtotime($from));
        $to = date('Y-m-d', strtotime($to));

        $total = Invoice::whereBetween('created_at', [$from, $to])->where('user_id', $userId)->sum('total');
        $vat = Invoice::whereBetween('created_at', [$from, $to])->where('user_id', $userId)->sum('vat');
        $payable = Invoice::whereBetween('created_at', [$from, $to])->where('user_id', $userId)->sum('payable');
        $due = Invoice::whereBetween('created_at', [$from, $to])->where('user_id', $userId)->sum('due');

        $list = Invoice::whereBetween('created_at', [$from, $to])->where('user_id', $userId)->with('customer')->get();

        $data = [
            'total' => $total,
            'vat' => $vat,
            'payable' => $payable,
            'due' => $due,
            'list' => $list,
            'from' => $from,
            'to' => $to

        ];

        $pdf = Pdf::loadView('report.reportPdf', $data);
        return $pdf->download('report.pdf');

        // return view('report.reportPdf',$data);
    }
}
