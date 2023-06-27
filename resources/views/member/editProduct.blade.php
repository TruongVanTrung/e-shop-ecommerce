@extends('layout.member.main')
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var val = $(".status").find(":selected").val();
            @if (Auth::check() == false)
                return false;
            @endif
            if (val == 0) {
                $("#sale").hide();
                //$("#sale input#inputSale").attr('value', '0');
            }
            $(document).on('change', '.status', function(e) {
                e.preventDefault();
                $('option:selected', this).removeAttr('selected');
                if (val == 1) {
                    $("#sale").slideDown();
                    $("#sale input#inputSale").attr('value', '{{ $data->sale }}');
                    alert(val);
                } else {
                    $("#sale").slideUp();
                    $("#sale input#inputSale").val('0');
                    alert(val);
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

                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">EDIT</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="POST"
                            action="{{ url('/member/account/edit-product/' . $data->id . '/update') }}"
                            enctype="multipart/form-data">
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
                                <p>price</p>
                                <input type="text" name="price" value="{{ $data->price }}" class="form-control"
                                    placeholder="">
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <p>Category</p>
                                <select name="category" id="" class="form-control">
                                    @foreach ($category as $item)
                                        @if ($item->id == $data->id_category)
                                            <option selected value="{{ $item->id }}">{{ $item->category }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->category }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <p>Brand</p>
                                <select name="brand" id="" class="form-control">
                                    @foreach ($brand as $val)
                                        @if ($val->id == $data->id_brand)
                                            <option selected value="{{ $val->id }}">{{ $val->brand }}</option>
                                        @else
                                            <option value="{{ $val->id }}">{{ $val->brand }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('brand')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Status</p>
                                <select name="status" id="status" class="form-control status">
                                    @if ($data->status == 0)
                                        <option selected value="0">New</option>
                                        <option value="1">Sale</option>
                                    @else
                                        <option value="0">New</option>
                                        <option selected value="1">Sale</option>
                                    @endif

                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12" id="sale">
                                <p>% sale</p>
                                <input type="text" name="sale" value="{{ $data->sale }}" id="inputSale"
                                    class="form-control" placeholder="">
                                @error('sale')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Company</p>
                                <input type="text" name="company" value="{{ $data->company }}" class="form-control">
                                @error('company')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Detail</p>
                                <input type="text" name="detail" value="{{ $data->detail }}" class="form-control">
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
                                @foreach (json_decode($data->image) as $image)
                                    <img style="width:60px; height:60px"
                                        src="{{ asset('upload/product/' . Auth::user()->id . '/2_' . $image) }}"
                                        alt="">
                                    <img src="" alt="">
                                    <input type="checkbox" class="" name="check_image[]"
                                        value="{{ $image }}">
                                @endforeach
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
