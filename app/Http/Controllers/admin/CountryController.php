<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\CountryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function index()
    {
        $data = DB::table('country')->get();
        return view('admin.country', ['data' => $data]);
    }

    public function viewAddCountry()
    {
        return view('admin.addCountry');
    }
    public function addCountry(CountryRequest $request)
    {
        // $query = DB::table('country')->insert(
        //     [
        //         'name' => $request->name
        //     ]
        // );
        $country = new CountryModel();
        $country->name = $request->name;
        if ($country->save()) {
            return redirect('/country');
        }
        //return view('admin.addCountry');
    }
    public function edit(string $id)
    {
        $data = CountryModel::find($id);
        return view('admin.editCountry', ['data' => $data]);
    }
    public function update(CountryRequest $request, string $id)
    {
        $country = CountryModel::find($id);
        $country->name = $request->name;
        if ($country->save()) {
            return redirect('/country/list');
        }
    }
    public function delete(string $id)
    {
        if (CountryModel::destroy($id)) {
            return redirect('/country/list');
        }
    }
}
