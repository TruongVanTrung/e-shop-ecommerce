<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\BlogsModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BlogsModel::all();
        return view('admin.blog', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addBlogs');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $file = $request->image;
        //dd($request);
        $blog = new BlogsModel();

        $blog->title = $request->title;
        $blog->image = $file->getClientOriginalName();
        $blog->description = $request->description;
        $blog->content = $request->content;

        if ($blog->save()) {

            $file->move('upload/user/blogs', $file->getClientOriginalName());

            return redirect('/admin/blogs');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = BlogsModel::find($id);
        return view('admin.editBlogs', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, string $id)
    {
        $query = BlogsModel::find($id);
        $data = $request->all();
        $file = $request->image;
        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        } else {
            $data['image'] = $query->image;
        }
        $query->title = $data['title'];
        $query->image = $data['image'];
        $query->description = $data['description'];
        $query->content = $data['content'];

        if ($query->save()) {
            if (!empty($file)) {
                $file->move('upload/user/blogs', $file->getClientOriginalName());
            }

            return redirect('/admin/blogs');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (BlogsModel::destroy($id)) {
            return redirect('/admin/blogs');
        }
    }
}
