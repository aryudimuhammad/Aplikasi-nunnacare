<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pesanan_detail;
use Illuminate\Http\Request;
use PDF;

class CetakController extends Controller
{
    public function nota(Request $request)
    {
    	$data = Pesanan::where('notransaksi',$request->notransaksi)->first();
    	$data1 = Pesanan_detail::where('notransaksi',$request->notransaksi)->get();


        $pdf = PDF::loadview('cetak.nota', compact('data','data1'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('cetak-nota-pdf');
    }
}
