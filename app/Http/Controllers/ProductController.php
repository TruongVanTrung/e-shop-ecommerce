<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProductModel::where('id_user', Auth::user()->id)->get();

        return view('member.myProduct', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = CategoryModel::all();
        $brand = BrandModel::all();
        return view('member.addProduct', ['category' => $category, 'brand' => $brand]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data_image = [];
        if ($request->image) {
            foreach ($request->image as $key => $image) {
                if ($key == 3) {
                    return redirect('/member/account/add-product/view')->with('succes', 'Chỉ được thêm ba ảnh');
                }
                $time =  strtotime(date('Y-m-d H:i:s'));
                $name = $time . '_' . $image->getClientOriginalName();
                $name_2 = "2" . '_' . $time . '_' . $image->getClientOriginalName();
                $name_3 = "3" . '_' . $time . '_' . $image->getClientOriginalName();

                $data_image[] = $name;
                if (!is_dir(public_path('/upload/product/' . Auth::user()->id))) {
                    if (!is_dir(public_path('/upload/product/'))) {
                        mkdir(public_path('/upload/product/'));
                    }
                    mkdir(public_path('/upload/product/' . Auth::user()->id));
                }


                // $image->move('upload/product/' . Auth::user()->id, $name);
                // $image->move('upload/product/' . Auth::user()->id, $name_2);
                // $image->move('upload/product/' . Auth::user()->id, $name_3);

                $path = public_path('upload/product/' . Auth::user()->id . '/' . $name);
                $path2 = public_path('upload/product/' . Auth::user()->id . '/' . $name_2);
                $path3 = public_path('upload/product/' . Auth::user()->id . '/' . $name_3);
                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(85, 84)->save($path2);
                Image::make($image->getRealPath())->resize(329, 380)->save($path3);
            }
        }
        $product = new ProductModel();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->id_category = $request->category;
        $product->id_brand = $request->brand;
        $product->status = $request->status;
        $product->sale = $request->sale;
        $product->company = $request->company;
        $product->image = json_encode($data_image);
        $product->detail = $request->detail;
        $product->id_user = Auth::user()->id;

        if ($product->save()) {
            return redirect('/member/account/my-product');
        }
        //dd(json_encode($data_image));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = ProductModel::find($id);
        return view('member.detailProduct', ['data' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = ProductModel::find($id);
        $category = CategoryModel::all();
        $brand = BrandModel::all();
        return view('member.editProduct', ['data' => $data, 'category' => $category, 'brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $product = ProductModel::find($id);

        $x = 0;
        $image_product = json_decode($product->image);
        $y = count($image_product);
        //dd($y);
        if ($request->check_image) {
            if ($y == 3) {
                $x = 0;
            } elseif ($y == 2) {
                $x = 1;
            } elseif ($y == 1) {
                $x = 2;
            }
            foreach ($request->check_image as $keyy => $item) {
                $x += 1;
            }
            if ($request->check_image) {
                foreach ($request->check_image as $val) {
                    foreach ($image_product as $keyi => $v) {
                        if ($v == $val) {
                            unset($image_product[$keyi]);
                        }
                    }
                    if (File::exists(public_path('/upload/product/' . Auth::user()->id . '/' . $val))) {
                        File::delete(public_path('/upload/product/' . Auth::user()->id . '/' . $val));
                    } else {
                        dd('File does not exists.');
                    }

                    if (File::exists(public_path('/upload/product/' . Auth::user()->id . '/2_' . $val))) {
                        File::delete(public_path('/upload/product/' . Auth::user()->id . '/2_' . $val));
                    } else {
                        dd('File does not exists.');
                    }
                    if (File::exists(public_path('/upload/product/' . Auth::user()->id . '/3_' . $val))) {
                        File::delete(public_path('/upload/product/' . Auth::user()->id . '/3_' . $val));
                    } else {
                        dd('File does not exists.');
                    }
                }
            }
        } else {
            $x = 3 - $y;
        }
        //dd($x);
        if ($request->image) {

            $data_image = $image_product;
            $keyy = array_key_last($request->image);
            if ($keyy >= $x) {
                return redirect()->back()->with('succes', 'Chỉ được thêm' . $x . ' ảnh');
            }
            foreach ($request->image as $key => $image) {
                // $lastKey = array_key_last($array); 
                $time =  strtotime(date('Y-m-d H:i:s'));
                $name = $time . '_' . $image->getClientOriginalName();
                $name_2 = "2" . '_' . $time . '_' . $image->getClientOriginalName();
                $name_3 = "3" . '_' . $time . '_' . $image->getClientOriginalName();

                $data_image[] = $name;
                if (!is_dir(public_path('/upload/product/' . Auth::user()->id))) {
                    if (!is_dir(public_path('/upload/product/'))) {
                        mkdir(public_path('/upload/product/'));
                    }
                    mkdir(public_path('/upload/product/' . Auth::user()->id));
                }

                $path = public_path('upload/product/' . Auth::user()->id . '/' . $name);
                $path2 = public_path('upload/product/' . Auth::user()->id . '/' . $name_2);
                $path3 = public_path('upload/product/' . Auth::user()->id . '/' . $name_3);
                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(85, 84)->save($path2);
                Image::make($image->getRealPath())->resize(329, 380)->save($path3);
            }


            $product->name = $request->name;
            $product->price = $request->price;
            $product->id_category = $request->category;
            $product->id_brand = $request->brand;
            $product->status = $request->status;
            $product->sale = $request->sale;
            $product->company = $request->company;
            $product->image = json_encode($data_image);
            $product->detail = $request->detail;
            $product->id_user = Auth::user()->id;
            //dd($data_image);

            if ($product->save()) {
                return redirect('/member/account/my-product');
            }
        } else {
            //dd($image);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->id_category = $request->category;
            $product->id_brand = $request->brand;
            $product->status = $request->status;
            $product->sale = $request->sale;
            $product->company = $request->company;
            $product->image = json_encode($image_product);
            $product->detail = $request->detail;
            $product->id_user = Auth::user()->id;

            if ($product->save()) {
                return redirect('/member/account/my-product');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductModel $productModel)
    {
        //
    }
}
