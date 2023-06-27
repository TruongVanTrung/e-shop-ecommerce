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
                <a class="button_rl btn btn-primary " id=""><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li>
        @foreach ($cmt as $value)
            @if ($value->level != 0 && $value->level == $item->id)
                <li class="media second-media" style="margin-top: -6%">
                    <img style="width:60px; height:60px" class="media-object"
                        src="{{ asset('upload/user/avatar/' . $value->avatar) }}" alt="">
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
        <li class="body_rl body_rl_{{ $item->id }} " style="display: none">
            <div class="text-area">
                <div class="blank-arrow">
                    <label>
                        @if (Auth::check())
                            {{ Auth::user()->name }}
                        @endif
                    </label>
                </div>
                <textarea name="message" class="message" rows="1"></textarea>
                <input type="hidden" value="{{ $item->id }}" class="id-cmt" name="id_cmt">
                <button type="submit" class="btn btn-primary rl-comment" id="">post
                    comment</button>
            </div>
        </li>
    @endif
@endforeach
