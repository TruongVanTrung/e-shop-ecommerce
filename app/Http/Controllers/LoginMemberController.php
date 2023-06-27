<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\CountryModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMemberController extends Controller
{
    public function index()
    {
        $data = CountryModel::all();
        return view('member.register', ['country' => $data]);
    }

    public function create(UserRequest $request)
    {
        $data = $request->all();

        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        } else {

            $data['avatar'] = "";
        }
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }
        $query = new User();
        $query->name = $data['name'];
        $query->email = $data['email'];
        $query->password = $data['password'];
        $query->phone = $data['phone'];
        $query->address = $data['address'];
        $query->avatar = $data['avatar'];
        $query->level = 1;

        if ($query->save()) {
            return redirect()->back();
        }
    }

    public function viewLogin()
    {
        return view('member.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate(
            [
                'email' => 'required|email|max:255',
                'password' => 'required|max:255'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute độ dài tối đa :max',
                'email' => ':attribute dữ liệu nhập vào phải là email'
            ],
            [
                'email' => 'Email',
                'password' => 'Password'
            ]
        );
        $remember = false;
        if ($request->remember_me) {
            $remember = true;
        }
        //dd($request);
        if (Auth::attempt($data, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        } else {
            dd($request);
        }
        //dd($request);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        //$request->session()->regenerateToken();

        return redirect('/');
    }
}
