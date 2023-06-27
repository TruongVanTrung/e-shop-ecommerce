@extends('layout.main')

@section('title')
    Trang chủ
@endsection
@section('main')
    <div class="row">
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" action="{{ url('/admin/blogs') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Image</label>
                            <div class="col-md-12">
                                <input type="file" name="image" id="image" class="form-control form-control-line">
                            </div>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Title</label>
                            <div class="col-md-12">
                                <input type="text" name="title" placeholder="" class="form-control form-control-line"
                                    value="">
                            </div>
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Description</label>
                            <div class="col-md-12">
                                <input type="text" name="description" placeholder=""
                                    class="form-control form-control-line">
                            </div>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Content</label>
                            <div class="col-md-12">
                                <textarea id="editor" name="content">
                                    <p>This is some sample content.</p>
                                </textarea>
                            </div>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit">Create blogs</button>
                            </div>
                        </div>
                    </form>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p style="color: red;margin-top: 15px">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
