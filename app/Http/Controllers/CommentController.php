<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        //dd($request);
        $request->validate(
            [
                'message' => 'required|max:255',
                'id_blog' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute độ dài tối đa là :max',
            ],
            [
                'message' => 'Bình luận',
                'id_blog' => 'id_blog'
            ]
        );

        $query = new CommentModel();
        $query->content = $request->message;
        $query->name = Auth::user()->name;
        $query->avatar = Auth::user()->avatar;
        $query->id_user = Auth::user()->id;
        $query->id_blog = $request->id_blog;
        $query->level = 0;

        if ($query->save()) {
            $comment = CommentModel::where('id_blog', $request->id_blog)->orderBy('id', 'asc')->get();
            return view('member.bodyComment', ['cmt' => $comment]);
            //return redirect()->back();
        }
    }

    public function replyCMT(Request $request)
    {
        $request->validate(
            [
                'message' => 'required|max:255',
                'id_blog' => 'required',
                'id_cmt' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute độ dài tối đa là :max',
            ],
            [
                'message' => 'Bình luận',
                'id_blog' => 'id_blog',
                'id_cmt' => 'id_cmt'
            ]
        );

        $query = new CommentModel();
        $query->content = $request->message;
        $query->name = Auth::user()->name;
        $query->avatar = Auth::user()->avatar;
        $query->id_user = Auth::user()->id;
        $query->id_blog = $request->id_blog;
        $query->level =  $request->id_cmt;

        if ($query->save()) {
            $comment = CommentModel::where('id_blog', $request->id_blog)->orderBy('id', 'asc')->get();
            return view('member.bodyComment', ['cmt' => $comment]);
        }
    }
}
