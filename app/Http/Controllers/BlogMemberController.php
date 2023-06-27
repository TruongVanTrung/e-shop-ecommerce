<?php

namespace App\Http\Controllers;

use App\Models\BlogsModel;
use App\Models\CommentModel;
use App\Models\RateModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogMemberController extends Controller
{
    public function index()
    {
        $data = BlogsModel::paginate(3);

        return view('member.blogs', ['data' => $data]);
    }

    public function detail(string $id)
    {
        $data = BlogsModel::find($id);

        $totalRate = RateModel::where('id_blog', $id)->avg('rate');
        //dd($totalRate);
        $rate = round($totalRate);

        $next = BlogsModel::where('id', '>', $id)->orderBy('id', 'asc')->first();

        $pre = BlogsModel::where('id', '<', $id)->orderBy('id', 'desc')->first();

        $cmt = CommentModel::where('id_blog', $id)->orderBy('id', 'asc')->get();

        return view('member.blogDetail', ['data' => $data, 'next' => $next, 'prev' => $pre, 'rate' => $rate, 'cmt' => $cmt]);
    }

    public function page(string $id, string $page)
    {
    }
}
