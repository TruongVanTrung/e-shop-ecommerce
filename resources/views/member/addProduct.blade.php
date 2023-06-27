@extends('layout.member.main')
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#sale").hide();
            $("#sale input#inputSale").attr('value', '0');
            @if (Auth::check() == false)
                return false;
            @endif
            $(document).on('change', '.status', function(e) {
                e.preventDefault();
                var val = $(".status").find(":selected").val();
                if (val == 1) {
                    $("#sale").show();
                } else {
                    $("#sale").hide();
                    $("#sale input#inputSale").attr('value', '0');
                }
            });
        });
    </script>
@endsection
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
                            action="{{ url('/member/account/add-product') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group col-md-6">
                                <p>Name</p>
                                <input type="text" name="name" class="form-control" value="" placeholder="">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <p>price</p>
                                <input type="text" name="price" value="" class="form-control" placeholder="">
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <p>Category</p>
                                <select name="category" id="" class="form-control">
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->category }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <p>Brand</p>
                                <select name="brand" id="" class="form-control">
                                    @foreach ($brand as $item)
                                        <option value="{{ $item->id }}">{{ $item->brand }}</option>
                                    @endforeach
                                </select>
                                @error('brand')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Status</p>
                                <select name="status" id="status" class="form-control status">
                                    <option value="0">New</option>
                                    <option value="1">Sale</option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12" id="sale">
                                <p>% sale</p>
                                <input type="text" name="sale" value="" id="inputSale" class="form-control"
                                    placeholder="">
                                @error('sale')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Company</p>
                                <input type="text" name="company" class="form-control">
                                @error('company')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Detail</p>
                                <input type="text" name="detail" class="form-control">
                                @error('detail')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Image</p>
                                <input type="file" name="image[]" multiple class="form-control">
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @if (session('succes'))
                                    <div class="alert alert-success">
                                        {{ session('succes') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" id="submit" class="btn btn-primary pull-right"
                                    value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/#contact-page-->
@endsection
