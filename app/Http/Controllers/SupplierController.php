<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function supplier()
    {
        $data = Supplier::orderBy('id', 'desc')->get();

        return view('admin.supplier',compact('data'));
    }
}
