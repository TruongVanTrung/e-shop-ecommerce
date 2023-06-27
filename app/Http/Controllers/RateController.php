<?php

namespace App\Http\Controllers;

use App\Models\RateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'rate' => 'required',
                'id_blog' => 'required'
            ]
        );
        //dd($request);
        $id_user = Auth::user()->id;

        $query = new RateModel();
        $query->rate = $request->rate;
        $query->id_user = $id_user;
        $query->id_blog = $request->id_blog;

        $query->save();
        echo $id_user;
    }
}
