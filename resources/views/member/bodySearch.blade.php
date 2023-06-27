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
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                            cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{ $item->price }}</h2>
                            <p>{{ $item->name }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                                cart</a>
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
