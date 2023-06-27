@extends('layout.member.main')

@section('main')
    <div id="contact-page" class="container" style="margin-top: -100px">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">PRODUCT <strong></strong></h2>
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
                    <a href="{{ url('/member/account/add-product/view') }}">
                        <h4>ADD PRODUCT</h4>
                    </a>
                    @if (empty($data[0]))
                        <h4>Không có sản phẩm</h4>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>image</th>
                                    <th>price</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @foreach (json_decode($item->image) as $image)
                                                    <img style="width:60px; height:60px"
                                                        src="{{ asset('upload/product/' . Auth::user()->id . '/2_' . $image) }}"
                                                        alt="">
                                                    <img src="" alt="">
                                                @endforeach
                                            </td>
                                            <td>{{ $item->price }}</td>
                                            <td><a href="{{ url('/member/account/edit-product/' . $item->id . '/edit') }}"><button
                                                        type="submit" name="edit" class="btn btn-outline-primary">
                                                        Sửa</button></a></td>
                                            <td>Delete</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
