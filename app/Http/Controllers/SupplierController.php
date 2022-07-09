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
    public function detailsupplier($id)
    {
        $data = Produk::orderBy('id', 'desc')->where('supplier_id', $id)->get();
        $supplier = Supplier::where('id', $id)->first();

        return view('detail.supplier',compact('data','supplier'));
    }
}
