<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data = ProductModel::limit(6)->orderby('created_at', 'asc')->get();
        return view('member.index', ['data' => $data]);
    }
}
