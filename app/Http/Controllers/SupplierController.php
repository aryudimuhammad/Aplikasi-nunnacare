<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function supplier()
    {
        $data = Supplier::orderBy('id', 'desc')->get();

        return view('admin.supplier',compact('data'));
    }
    public function tambahsupplier(Request $request)
    {
        $data = new Supplier();
        $data->nama = $request->nama;
        $data->telepon = $request->telepon;
        $data->alamat = $request->alamat;
        $data->save();

        return back()->with('success', 'Data Berhasil Disimpan.');
    }
    public function deletesupplier($id)
    {
        $data = Supplier::where('id', $id)->first();
        $data->delete();

        return back()->with('success', 'Data Berhasil Dihapus');
    }
    public function detailsupplier(Request $request, $id)
    {
        $data = Supplier::where('id', $id)->first();

        return view('admin.supplierdetail',compact('data'));
    }

    public function editsupplier(Request $request, $id)
    {
        $data = Supplier::where('id',$id)->first();
            $data->nama = $request->nama;
            $data->telepon = $request->telepon;
            $data->alamat = $request->alamat;
            $data->update();
            return back()->with('success', 'Data Berhasil Diubah');

        return back()->with('success', 'Data Berhasil Diubah');
    }

}
