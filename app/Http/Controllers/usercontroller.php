<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class usercontroller extends Controller
{
    public function user()
    {
        $data = User::orderBy('id', 'desc')->get();

        return view('admin.user',compact('data'));
    }
}
