<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function checkout(Request $request, $id)
    {
        $kategori = Kategori::orderBy('id', 'desc')->get();
        $data = Produk::where('id', $id)->first();

        $result = Pesanan::where('produk_id', $id)->where('user_id', Auth()->user()->id)->first();
        if (empty($result)) {
            $result = new Pesanan();
            $result->produk_id = $request->produk_id;
            $result->user_id = $request->user_id;
            $result->jumlah_produk = 1;
            $result->save();
         } elseif($request->jumlah_produk) {
            $result = Pesanan::where('produk_id', $id)->first();
            $result->jumlah_produk = $request->jumlah_produk;
            $result->update();
         }
         else {
            $result = Pesanan::where('produk_id', $id)->first();
            $result->jumlah_produk = $result->jumlah_produk + 1;
            $result->update();
         }

         $count = Pesanan::where('produk_id', $id)->where('user_id', Auth()->user()->id)->get();

        return view('welcome.checkout', compact('data','kategori','result','count'));
    }
}
