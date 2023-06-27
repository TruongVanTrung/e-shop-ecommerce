@extends('layout.member.main')

@section('main')
    <div id="contact-page" class="container" style="margin-top: -100px">
        <div class="bg">
            <div class="row">
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">REGISTER</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form action="{{ url('/member/register/add') }}" id="main-contact-form" class="contact-form row"
                            name="contact-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-6">
                                <p>Name</p>
                                <input type="text" name="name" class="form-control" placeholder="">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <p>Email</p>
                                <input type="email" name="email" class="form-control" placeholder="">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                <input type="text" name="password" required class="form-control" placeholder="">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Phone</p>
                                <input type="text" name="phone" class="form-control" placeholder="">
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <p>Address</p>
                                <input type="text" name="address" class="form-control" placeholder="">
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <p>Select Country</p>

                                <select name="country" class="form-control form-control-line">
                                    @isset($country)
                                        @foreach ($country as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endisset
                                    {{--  --}}
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
