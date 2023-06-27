@extends('layout.member.main')
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        if (screen.width <= 736) {
            document.getElementById("viewport").setAttribute("content",
                "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
        }
    </script>
    <link type="text/css" rel="stylesheet" href="{{ asset('member/css/rate.css') }}">
    <script src="{{ asset('member/js/jquery-1.9.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            //vote

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.ratings_stars').hover(
                // Handles the mouseover
                function() {
                    $(this).prevAll().andSelf().addClass('ratings_hover');
                    // $(this).nextAll().removeClass('ratings_vote'); 
                },
                function() {
                    $(this).prevAll().andSelf().removeClass('ratings_hover');
                    // set_votes($(this).parent());
                }
            );

            $('.ratings_stars').click(function(e) {
                e.preventDefault();

                @if (Auth::check() == false)
                    alert('Vui lòng đăng nhập trước khi đánh giá');
                @else
                    var Values = $(this).find("input").val();
                    $.ajax({
                        method: "POST",
                        url: "/member/rate/add",
                        data: {
                            id_blog: '{{ $data->id }}',
                            rate: Values
                        },
                        success: function(res) {
                            console.log(res)
                        }
                    });
                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    } else {
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    }
                @endif
            });
            $(document).on('click', '#comment', function(e) {
                e.preventDefault();
                @if (Auth::check() == false)
                    alert('Vui lòng đăng nhập trước khi đánh giá');
                    return false;
                @endif
                var mes = $(this).closest('.text-area').find(".message").val();
                // return true;
                $.ajax({
                    method: "POST",
                    url: "/member/comment/add",
                    data: {
                        id_blog: '{{ $data->id }}',
                        message: mes
                    },
                    success: function(res) {
                        console.log(res);
                        $("#media-list").html(res);
                    }
                });
            });

            $(document).on('click', '.rl-comment', function(e) {
                e.preventDefault();
                @if (Auth::check() == false)
                    alert('Vui lòng đăng nhập trước khi đánh giá');
                    return false;
                @endif
                var mes = $(this).closest('.text-area').find(".message").val();
                var id_cmt = $(this).closest('.text-area').find("input").val();
                //alert(mes + ',' + id_cmt);
                $.ajax({
                    method: "POST",
                    url: "/member/comment/reply/add",
                    data: {
                        id_blog: '{{ $data->id }}',
                        message: mes,
                        id_cmt: id_cmt
                    },
                    success: function(res) {
                        console.log(res);
                        $("#media-list").html(res);
                    }
                });
            });
            $(document).on('click', '.button_rl', function(e) {
                e.preventDefault();
                var id = $(this).closest('.media-body').find("input").val();
                var class_rl = ".body_rl_" + id;

                $(".body_rl").slideUp();
                $(class_rl).slideDown();
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
                <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Latest From our Blog</h2>
                        <div class="single-blog-post">
                            <h3>{{ $data->title }}</h3>
                            <div class="post-meta">
                                <ul>
                                    <li><i class="fa fa-user"></i> Mac Doe</li>
                                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                </ul>
                            </div>
                            <a href="">
                                <img src="{{ asset('upload/user/blogs/' . $data->image) }}" alt="">
                            </a>
                            <p>
                                {{ $data->description }}</p> <br>

                            <p>
                                {!! $data->content !!}</p> <br>
                            <div class="pager-area">
                                <ul class="pager pull-right">
                                    @if ($next == null)
                                        <li><a href="{{ url('/member/blogs/' . $prev->id) }}">Pre</a></li>
                                    @elseif($prev == null)
                                        <li><a href="{{ url('/member/blogs/' . $next->id) }}">Next</a></li>
                                    @else
                                        <li><a href="{{ url('/member/blogs/' . $prev->id) }}">Pre</a></li>
                                        <li><a href="{{ url('/member/blogs/' . $next->id) }}">Next</a></li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/blog-post-area-->

                    <div class="rating-area">
                        <ul class="ratings">
                            <li class="rate-this">Rate this item:</li>
                            <li>
                                <div class="rate">
                                    <div class="vote">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $rate)
                                                <div class="star_1 ratings_stars ratings_over">
                                                </div>
                                            @else
                                                <div class="star_1 ratings_stars">
                                            @endif
                                        @endfor
                                    </div>
                                </div>

                            </li>
                            <li class="color">({{ $rate }}*)</li>
                        </ul>
                        <ul class="tag">
                            <li>TAG:</li>
                            <li><a class="color" href="">Pink <span>/</span></a></li>
                            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                            <li><a class="color" href="">Girls</a></li>
                        </ul>

                    </div>
                    <div class="rate">
                        <div class="vote">
                            <div class="star_1 ratings_stars "><input value="1" type="hidden"></div>
                            <div class="star_2 ratings_stars "><input value="2" type="hidden"></div>
                            <div class="star_3 ratings_stars "><input value="3" type="hidden"></div>
                            <div class="star_4 ratings_stars "><input value="4" type="hidden"></div>
                            <div class="star_5 ratings_stars "><input value="5" type="hidden"></div>
                        </div>
                    </div>
                    <!--/rating-area-->

                    <div class="socials-share">
                        <a href=""><img src="images/blog/socials.png" alt=""></a>
                    </div>
                    <div class="response-area">
                        <h2>3 RESPONSES</h2>

                        <ul class="media-list" id="media-list">
                            @foreach ($cmt as $item)
                                @if ($item->level == 0)
                                    <li class="media" style="margin-top: 6%">
                                        <a class="pull-left" href="#">
                                            <img style="width:60px; height:60px" class="media-object"
                                                src="{{ asset('upload/user/avatar/' . $item->avatar) }}" alt="">
                                        </a>
                                        <div class="media-body">
                                            <ul class="sinlge-post-meta">
                                                <li><i class="fa fa-user"></i>{{ $item->name }}</li>
                                                <li><i class="fa fa-clock-o"></i> {{ $item->created_at }}</li>
                                                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                            </ul>
                                            <p>{{ $item->content }}</p>
                                            <input type="hidden" value="{{ $item->id }}">
                                            <a class="button_rl btn btn-primary " id=""><i
                                                    class="fa fa-reply"></i>Replay</a>
                                        </div>
                                    </li>
                                    @foreach ($cmt as $value)
                                        @if ($value->level != 0 && $value->level == $item->id)
                                            <li class="media second-media" style="margin-top: -6%">
                                                <a class="pull-left" href="#">
                                                    <img style="width:60px; height:60px" class="media-object"
                                                        src="{{ asset('upload/user/avatar/' . $value->avatar) }}"
                                                        alt="">
                                                </a>
                                                <div class="media-body">
                                                    <ul class="sinlge-post-meta">
                                                        <li><i class="fa fa-user"></i>{{ $value->name }}</li>
                                                        <li><i class="fa fa-clock-o"></i> {{ $value->created_at }}</li>
                                                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                                    </ul>
                                                    <p>{{ $value->content }}
                                                    </p>

                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li class="body_rl body_rl_{{ $item->id }}" style="display: none">
                                        <div class="text-area">
                                            <div class="blank-arrow">
                                                <label>
                                                    @if (Auth::check())
                                                        {{ Auth::user()->name }}
                                                    @endif
                                                </label>
                                            </div>
                                            <textarea name="message" class="message" rows="1"></textarea>
                                            <input type="hidden" value="{{ $item->id }}" class="id-cmt"
                                                name="id_cmt">
                                            <button type="submit" class="btn btn-primary rl-comment"
                                                id="rl_comment">post
                                                comment</button>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>


                    </div>
                    <!--/Response-area-->
                    <div class="replay-box">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Leave a replay</h2>

                                <div class="text-area">
                                    <div class="blank-arrow">
                                        <label>
                                            @if (Auth::check())
                                                {{ Auth::user()->name }}
                                            @endif
                                        </label>
                                    </div>
                                    <span>*</span>
                                    {{-- <form action="{{ url('/member/comment/add') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf --}}
                                    <textarea name="message" class="message" rows="11"></textarea>
                                    <button type="submit" class="btn btn-primary" id="comment">post
                                        comment</button>
                                    @error('message')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Repaly Box-->
                </div>
            </div>
        </div>
    </section>
@endsection
