@extends('layout.main')

@section('title')
    Trang chủ
@endsection
@section('main')
    <div class="row">
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" action="{{ url('admin/country/update/' . $data->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="col-md-12">Name COuntry</label>
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="" class="form-control form-control-line"
                                    value="{{ $data->name }}">
                            </div>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit">Update Country</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
