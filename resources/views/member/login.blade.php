@extends('layout.member.main')

@section('main')
    <section id="form">
        <!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <!--login form-->
                        <h2>Login to your account</h2>
                        <form action="{{ url('/member/login/add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="email" placeholder="Email Address" name="email" />
                            <input type="password" placeholder="Password" name="password" />
                            <span>
                                <input type="checkbox" class="checkbox" name="remember_me">
                                Keep me signed in
                            </span>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div>
                    <!--/login form-->
                </div>
            </div>
        </div>
    </section>
    <!--/form-->
@endsection
