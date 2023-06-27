@extends('layout.member.main')
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.cart_quantity_up', function(e) {
                e.preventDefault();
                var countCart = $(this).closest("body").find(".shop-menu span").text();
                var countCart2 = parseInt(countCart);
                var neww = countCart2 + 1;
                $(this).closest("body").find(".shop-menu span").text(neww);
                var price = $(this).closest("tr").find(".cart_price p").text();
                var totalPrice = $(this).closest("body").find(".totalCart").text();

                $(this).closest("body").find(".totalCart").text(parseInt(totalPrice) + parseInt(price));
                $(this).closest("body").find("#totalCartForm").val(parseInt(totalPrice) + parseInt(price));

                var id = $(this).closest(".cart_quantity_button").find(".id_product").val();
                var qty = $(this).closest(".cart_quantity_button").find(".cart_quantity_input").val();
                $(this).closest(".cart_quantity_button").find(".cart_quantity_input").val(parseInt(qty) +
                    1);
                var totalPriceProduct = $(this).closest("tr").find(".cart_total_price").text();
                $(this).closest("tr").find(".cart_total_price").text(parseInt(totalPriceProduct) +
                    parseInt(price));
                $.ajax({
                    method: "POST",
                    url: "/cart/edit",
                    data: {
                        id: id,
                        function: 1
                    },
                    success: function(res) {
                        console.log(res);
                    }
                });
            });

            $(document).on('click', '.cart_quantity_down', function(e) {
                e.preventDefault();
                var countCart = $(this).closest("body").find(".shop-menu span").text();
                var countCart2 = parseInt(countCart);
                var neww = countCart2 - 1;
                $(this).closest("body").find(".shop-menu span").text(neww);
                var price = $(this).closest("tr").find(".cart_price p").text();
                var totalPrice = $(this).closest("body").find(".totalCart").text();
                $(this).closest("body").find(".totalCart").text(parseInt(totalPrice) - parseInt(price));
                $(this).closest("body").find("#totalCartForm").val(parseInt(totalPrice) - parseInt(price));
                var id = $(this).closest(".cart_quantity_button").find(".id_product").val();
                var qty = $(this).closest(".cart_quantity_button").find(".cart_quantity_input").val();

                if (qty > 1) {
                    $(this).closest(".cart_quantity_button").find(".cart_quantity_input").val(parseInt(
                            qty) -
                        1);
                    $(this).closest("tr").find(".cart_total_price").text((parseInt(qty) -
                        1) * parseInt(price));
                } else if (qty == 1) {
                    $(this).parents("tr").remove();
                }
                $.ajax({
                    method: "POST",
                    url: "/cart/edit",
                    data: {
                        id: id,
                        function: 2
                    },
                    success: function(res) {
                        console.log(res);
                    }
                });
            });

            $(document).on('click', '.cart_quantity_delete', function(e) {
                e.preventDefault();
                var countCart = $(this).closest("body").find(".shop-menu span").text();
                var countCart2 = parseInt(countCart);
                var price = $(this).closest("tr").find(".cart_price p").text();
                var totalPrice = $(this).closest("body").find(".totalCart").text();
                var qty = $(this).closest("tr").find(".cart_quantity_input").val();

                $(this).closest("body").find(".shop-menu span").text(countCart2 - parseInt(qty));

                $(this).closest("body").find(".totalCart").text(parseInt(totalPrice) - (parseInt(qty) *
                    parseInt(price)));
                $(this).closest("body").find("#totalCartForm").val(parseInt(totalPrice) - (parseInt(qty) *
                    parseInt(price)));
                var id = $(this).closest("tr").find(".id_product").val();
                $(this).parents("tr").remove();
                $.ajax({
                    method: "POST",
                    url: "/cart/edit",
                    data: {
                        id: id,
                        function: 3
                    },
                    success: function(res) {
                        console.log(res);
                    }
                });
            });
        });
    </script>
@endsection
@section('main')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @if (session()->has('cart'))
                            @foreach (session()->get('cart') as $item)
                                @php
                                    $t += $item['qty'] * $item['price'];
                                @endphp
                                <tr>
                                    <td class="cart_product">
                                        <a href=""><img src="{{ asset($item['image']) }}"
                                                style="height:60px; width:60px" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="">{{ $item['name'] }}</a></h4>
                                        <p>Web ID: 1089772</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ $item['price'] }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <input type="hidden" value="{{ $item['id'] }}" class="id_product">
                                            <a class="cart_quantity_up" id="up"> + </a>
                                            <input class="cart_quantity_input" type="text" name="quantity"
                                                value="{{ $item['qty'] }}" autocomplete="off" size="2">

                                            <a class="cart_quantity_down" id="down"> - </a>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">{{ $item['qty'] * $item['price'] }}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                    delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <form style="margin-left: 3%" id="main-contact-form" class="contact-form row" name="contact-form"
                            method="POST" action="{{ url('/cart/order') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group col-md-6">
                                <p>Name</p>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                    placeholder="">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <p>Email</p>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <p>Phone</p>
                                <input type="text" name="phone" class="form-control" placeholder=""
                                    value="{{ $user->phone }}">
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Address</p>
                                <input type="text" name="address" value="{{ $user->address }}" class="form-control"
                                    placeholder="">
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" value="{{ $t }}" name="total" id="totalCartForm">
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Order">
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">


                        <ul>
                            <li>Cart Sub Total<span class="totalCart"> {{ $t }}</span></li>
                            <li>Eco Tax <span>$2</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>$61</span></li>
                        </ul>
                        <a class="btn btn-default update" href="{{ url('/mail') }}">Update</a>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#do_action-->
    <!--/#cart_items-->
@endsection
