@extends('layout.member.main')
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.slider-horizontal', function() {
                var data = $(this).closest(".text-center").find(".tooltip-inner").text();
                var new_data = data.split(" ");
                //console.log(new_data[0] + ' ' + new_data[2]);
                $.ajax({
                    method: "POST",
                    url: "/search/price",
                    data: {
                        val1: new_data[0],
                        val2: new_data[2]
                    },
                    success: function(res) {
                        console.log(res);
                        $(".features_items").html(res);
                    }
                });
            });

        });
    </script>
@endsection
@section('main')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('layout.member.leftSlide')
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="container">
                        <div class="row">

                            <div class="chose_area">
                                <div class="user_info">
                                    <div class="row">
                                        <form action="{{ url('/search') }}" method="POST">
                                            @csrf
                                            <div class="col-sm-2">
                                                <div class="">
                                                    <input type="text" name="search" placeholder="Search name" />
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <select name="price">
                                                    <option>Choose Price</option>
                                                    <option value="1">1-50</option>
                                                    <option value="2">51-100</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select name="category">
                                                    <option value="0">Choose Category</option>
                                                    @if ($category)
                                                        @foreach ($category as $item)
                                                            <option value="{{ $item->id }}">{{ $item->category }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select name="brand">
                                                    <option value="0">Choose Brand</option>
                                                    @if ($brand)
                                                        @foreach ($brand as $item)
                                                            <option value="{{ $item->id }}">{{ $item->brand }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-1">
                                                <select name="status">
                                                    <option value="0">New</option>
                                                    <option value="1">Sale</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-1">
                                                <button name="submit" type="submit" class="btn">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <h2 class="title text-center">Features Items</h2>
                    <div class="features_items">
                        <!--features_items-->
                        @isset($data)
                            @foreach ($data as $item)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ asset('upload/product/' . $item->id_user . '/' . json_decode($item->image)[0]) }}"
                                                    alt="" />
                                                <h2>{{ $item->price }}</h2>
                                                <p>{{ $item->name }}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>{{ $item->price }}</h2>
                                                    <p>{{ $item->name }}</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a>
                                                </li>
                                                <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    <ul class="pagination">
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">&raquo;</a></li>
                    </ul>
                    <!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection
