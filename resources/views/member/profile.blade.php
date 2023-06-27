@extends('layout.member.main')

@section('main')
    <div id="contact-page" class="container" style="margin-top: -100px">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">PROFILE <strong></strong></h2>
                    <div id="gmap" class="contact-map">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="contact-info">
                        <div class="left-sidebar">
                            <h2>Category</h2>
                            <div class="panel-group category-products" id="accordian">
                                <!--category-productsr-->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="{{ url('/member/profile') }}">
                                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                Account
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="{{ url('/member/account/my-product') }}">
                                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                MyProduct
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="social-networks">
                            <h2 class="title text-center">Social Networking</h2>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Get In Touch</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="POST"
                            action="{{ url('/member/account/update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-6">
                                <p>Name</p>
                                <input type="text" name="name" class="form-control" value="{{ $data->name }}"
                                    placeholder="">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <p>Email</p>
                                <input type="email" name="email" readonly value="{{ $data->email }}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <p>Avatar</p>
                                <input type="file" name="avatar" class="form-control">
                                @error('avatar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <p>Password</p>
                                <input type="text" name="password" class="form-control"
                                    placeholder="{{ $data->password }}">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Phone</p>
                                <input type="text" name="phone" class="form-control" placeholder=""
                                    value="{{ $data->phone }}">
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Address</p>
                                <input type="text" name="address" value="{{ $data->address }}" class="form-control"
                                    placeholder="">
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Select Country</p>
                                <select name="country" class="form-control form-control-line">
                                    @foreach ($country as $item)
                                        @if ($item->id == $data->id_country)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('country')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/#contact-page-->
@endsection
