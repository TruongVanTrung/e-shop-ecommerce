@extends('layout.main')

@section('title')
    Trang chủ
@endsection
@section('main')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5><a href="{{ url('/admin/blogs/create') }}">Add Blogs</a></h5>
                        <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>
                            Table With Outside Padding</h6>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">content</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->title }}</td>
                                            <td><img src="{{ asset('upload/user/blogs/' . $item->image) }}"
                                                    class="rounded-circle" width="150" />
                                            </td>
                                            <td>{{ $item->description }}</td>
                                            <td>{!! $item->content !!}</td>
                                            <td><a href="{{ url('admin/blogs/' . $item->id . '/edit') }}"><button
                                                        type="submit" name="edit" class="btn btn-outline-primary">
                                                        Sửa</button></a></td>
                                            <td>
                                                <form action="{{ url('admin/blogs/' . $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" name="delete" class="btn btn-danger">
                                                        Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
