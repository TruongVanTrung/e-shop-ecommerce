<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $category = CategoryModel::all();
        $brand = BrandModel::all();
        $data = ProductModel::all();
        return view('member.search', ['data' => $data, 'category' => $category, 'brand' => $brand]);
    }
    public function search(Request $request)
    {
        $data = ProductModel::query();

        if ($request->search) {
            $data->where('name', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->category) {
            $data->where('id_category', 'LIKE', '%' . $request->category . '%');
        }
        if ($request->brand) {
            $data->where('id_brand', 'LIKE', '%' . $request->brand . '%');
        }
        if ($request->status) {
            $data->where('status', 'LIKE', '%' . $request->status . '%');
        }
        if ($request->price) {
            if ($request->price == 1) {
                $data->where('price', '>', 0)->where('price', '<=', 50);
            } elseif ($request->price == 2) {
                $data->where('price', '>', 50)->where('price', '<=', 100);
            }
        }
        // lay all product
        // neu co name
        //     sql: where 
        // neu co gia:
        //     where gia

        $category = CategoryModel::all();
        $brand = BrandModel::all();
        $search = $data->orderby('name')->paginate(3);
        return view('member.search', ['data' => $search, 'category' => $category, 'brand' => $brand]);
    }

    public function searchPrice(Request $request)
    {
        $request->validate(
            [
                'val1' => 'required',
                'val2' => 'required',
            ],
            [
                'required' => 'Bắt buộc'
            ]
        );

        $data = ProductModel::where('price', '>', $request->val1)->where('price', '<=', $request->val2)->orderby('name')->paginate(3);
        return view('member.bodySearch', ['data' => $data]);
    }
}
