<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\Pesanan_detail;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use ImageResize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Symfony\Component\Translation\Dumper\YamlFileDumper;

class PesananController extends Controller
{
    public function cart(Request $request, $id)
    {
        $kategori = Kategori::orderBy('id', 'desc')->get();
        $data = Produk::where('id', $request->produk_id)->first();
        $date = Carbon::now()->format('mdhis');


        $result = Pesanan_detail::where('produk_id', $request->produk_id)->where('user_id', $id)->whereNull('status')->first();
        if (empty($result)) {
            $result = new Pesanan_detail();
            $result->produk_id = $request->produk_id;
            $result->user_id = $request->user_id;
            $result->jumlah_produk = 1;
            $result->save();
        } elseif($request->jumlah_produk) {
            $result = Pesanan_detail::where('produk_id', $request->produk_id)->whereNull('status')->whereNull('notransaksi')->first();
            $result->jumlah_produk = $request->jumlah_produk;
            $result->update();
        } else{


            if($result->notransaksi == null && $result->status == null){
                $result = Pesanan_detail::where('produk_id', $request->produk_id)->where('user_id', $id)->whereNull('status')->whereNull('notransaksi')->first();
                $result->jumlah_produk = $result->jumlah_produk + 1;
                $result->update();
                }
            elseif($result->notransaksi == !null && $result->status == !null){
                $result = new Pesanan_detail();
                $result->produk_id = $request->produk_id;
                $result->user_id = $request->user_id;
                $result->jumlah_produk = 1;
                $result->save();
            }

        }

        $data1 = Pesanan_detail::where('user_id', $id)->whereNull('notransaksi')->get();
        $data2 = Pesanan_detail::where('user_id', $id)->whereNull('notransaksi')->first();

        return view('welcome.cart', compact('data','kategori','result','data1','data2','date'));
    }

    public function cartdelete($id,$idp)
    {
        $data = Pesanan::where('user_id', $id)->where('id', $idp)->first();
        $data->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function pembayaranlist(Request $request , $id)
    {
        $kategori = Kategori::orderBy('id', 'desc')->get();
        $data = Pesanan::orderby('id', 'desc')->where('status' , '<' , 5)->get();

        return view('welcome.pembayaranlist', compact('data','kategori'));
    }

    public function pembayaran(Request $request, $id ,$idn){
        $kategori = Kategori::orderBy('id', 'desc')->get();

        $data1 = Pesanan::where('notransaksi', $idn)->first();
        $data2 = Pesanan_detail::where('notransaksi', $idn)->get();

        return view('welcome.pembayaran', compact('kategori','data1','data2'));
    }

    public function pembayaran1(Request $request, $id){
        $kategori = Kategori::orderBy('id', 'desc')->get();
        $date = Carbon::now()->format('mdhis');

        if($request->name){
            $user = User::where('id', $id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->telepon = $request->telepon;
            $user->alamat = $request->alamat;
            $user->update();

            if($request->paymentMethod){
                $notransaksi = new Pesanan();
                $notransaksi->notransaksi = $date . $id;
                $notransaksi->metode_pembayaran = $request->paymentMethod;
                $notransaksi->status = 1;
                $notransaksi->save();
            }


        }
        $detail = Pesanan_detail::where('user_id',$id)->whereNull('status')->whereNull('notransaksi')->update(['notransaksi' => $date . $id, 'status' => 1]);
        $data = Pesanan::where('notransaksi', $notransaksi->notransaksi)->first();

        return view('welcome.pembayaran1', compact('kategori','data'));
    }

    public function buktipembayaran(Request $request)
    {
        $date = Carbon::now()->format('Ymd');
        $data = Pesanan::find($request->id);
        if ($request->bukti != null) {
            $img = $request->file('bukti');
            $FotoExt = $img->getClientOriginalExtension();
            $FotoName = $date . $request->id;
            $bukti = $FotoName . '.' . $FotoExt;
            $img->move('images/bukti', $bukti);
            $data->bukti = $bukti;
            $data->status = 3;
            $data->update();
        }


        return back()->with('success', 'Data Berhasil Dikirim');
    }
    public function diterima(Request $request)
    {
        $data = Pesanan::where('notransaksi',$request->notransaksi)->first();
        $data->status = 5;
        $data->update();

        Pesanan_detail::where('notransaksi',$request->notransaksi)->where('status', 2)->update(['status' => 5]);

        return back()->with('success','Terimasih Sudah Berbelanja Ditoko Kami.');
    }









    public function adminpesanan()
    {
        $data = Pesanan::orderBy('status','asc')->get();

        return view('admin.pesanan', compact('data'));
    }

    public function ongkiradminpesanan(Request $request)
    {
        $data = Pesanan::where('id', $request->id)->first();
        $data->ongkir = $request->ongkir;
        $data->status = 2;
        $data->update();

        return back()->with('success', 'Ongkir Telah Ditambahkan');
    }

    public function estimasiadminpesanan(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');

        $data = Pesanan::find($request->id);
        $data->estimasi = $request->estimasi;
        $data->jadwal_pengiriman = $date;
        $data->status = 4;
        $data->update();

        return back()->with('success','Data Berhasil Disimpan.');
    }
}
