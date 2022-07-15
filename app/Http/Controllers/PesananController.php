<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function indexcheckout($id,$uid)
    {
        return view('welcome.checkout');
    }


    public function cart(Request $request, $id)
    {
        $kategori = Kategori::orderBy('id', 'desc')->get();
        $data = Produk::where('id', $request->produk_id)->first();

        $result = Pesanan::where('produk_id', $request->produk_id)->where('user_id', $id)->first();
        if (empty($result)) {
            $result = new Pesanan();
            $result->produk_id = $request->produk_id;
            $result->user_id = $request->user_id;
            $result->jumlah_produk = 1;
            $result->status = 1;
            $result->save();
        } elseif($request->jumlah_produk) {
            $result = Pesanan::where('produk_id', $id)->first();
            $result->jumlah_produk = $request->jumlah_produk;
            $result->update();
         }
         else {
            $result = Pesanan::where('produk_id', $request->produk_id)->first();
            $result->jumlah_produk = $result->jumlah_produk + 1;
            $result->update();
         }

         $data1 = Pesanan::where('user_id', $id)->where('status', 1)->get();

        return view('welcome.cart', compact('data','kategori','result','data1'));
    }
}
