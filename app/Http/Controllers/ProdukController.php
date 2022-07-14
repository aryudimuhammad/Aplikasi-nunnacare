<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class ProdukController extends Controller
{
    public function welcome(Request $request)
    {
        $carousel = Produk::orderBy('id', 'desc')->paginate(3);
        $kategori = Kategori::orderBy('id', 'desc')->get();
        $produk = Produk::orderBy('id', 'desc')->paginate(9)->withQueryString();
        if ($request->kategori) {
            $produk = Produk::where('kategori_id', 'LIKE', '%' . $request->kategori . '%')->paginate();
        }
        if ($request->search) {
            $produk = Produk::where('nama_barang', 'LIKE', '%' . $request->search . '%')->paginate();

        }
        return view('welcome', compact('produk','carousel','kategori'));
    }

    public function dashboard(Request $request)
    {
        return view('admin.dashboard');
    }

    public function produk(Request $request)
    {
        $produk = Produk::orderBy('id', 'desc')->get();
        return view('admin.produk', compact('produk'));
    }

    public function detail(Request $request, $id)
    {
        $carousel = Produk::orderBy('id', 'desc')->paginate(3);
        $kategori = Kategori::orderBy('id', 'desc')->get();
        $produk = Produk::orderBy('id', 'desc')->paginate(9)->withQueryString();
        if ($request->kategori) {
            $produk = Produk::where('kategori_id', 'LIKE', '%' . $request->kategori . '%')->paginate();
        }
        if ($request->search) {
            $produk = Produk::where('nama_barang', 'LIKE', '%' . $request->search . '%')->paginate();

        }
        $data = Produk::where('id', $id)->first();

        return view('welcome.detail', compact('data','carousel','kategori'));
    }
}
