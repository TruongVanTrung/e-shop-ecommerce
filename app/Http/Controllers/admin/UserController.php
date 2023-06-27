<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $data = [];
        if (auth::check()) {
            $data = auth::user();
        }
        //dd($data->name);
        $country = DB::table('country')->get();
        return view('admin.profile', ['data' => $data, 'country' => $country]);
    }

    public function updateUser(UserRequest $request)
    {
        $userID = Auth::id();
        $user = User::find($userID);
        $data = $request->all();
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        } else {
            $data['avatar'] = $user->avatar;
        }
        //dd($data);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->password = $data['password'];
        $user->avatar = $data['avatar'];
        $user->id_country = $data['country'];
        if ($user->save()) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update success'));
        } else {
            return redirect()->back()->withErrors('Update error');
        }
        dd($data);
    }
}
