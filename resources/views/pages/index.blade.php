@extends("index")
@section("title","Trang Chủ")
@section("content")


    <div class="container">
        <div class="content-top">
            <div class="title_corner"><h3 class="words2">GIẢM GIÁ</h3></div>
            <div class="product1">
                <div class=" bottom-product">
                    @for ($i=0;$i<count($giam_gia);$i++)
                        <div class="bottom-cd simpleCart_shelfItem">
                            <div class="product-at">
                                <a href="http://localhost/Shopping/chi-tiet/{{$giam_gia[$i]->cate_alias}}/{{$giam_gia[$i]->alias}}">
                                    <img class="pro-img" src="{{url("/public/products")}}/{{$giam_gia[$i]->img1}}"
                                         alt="{{$giam_gia[$i]->name}}">
                                    <!--  <div class="pro-grid">
                                          <span class="buy-in">Chi tiết</span>
                                      </div>-->
                                </a>
                            </div>
                            <p class="percent"> {{$giam_gia[$i]->percent}} %</p>

                            <p class="brand"> Hãng sp </p>

                            <p class="cate">{{$sp_moi[$i]->cate}}</p>

                            <p class="code">{{$giam_gia[$i]->id}}</p>

                            <p class="tun"> {{$giam_gia[$i]->name}}</p>

                            <p class="price">
                                <del>{{number_format($giam_gia[$i]->price)}}</del>
                                {{number_format($giam_gia[$i]->price *(100-$giam_gia[$i]->percent)/100 )}}
                            </p>

                        </div>
                    @endfor
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="title_corner"><h3 class="words3">SẢN PHẨM MỚI</h3></div>
            <div class=" product1">

                <div class=" bottom-product">
                    @for ($i=0;$i<count($sp_moi);$i++)
                        <div class="bottom-cd simpleCart_shelfItem">
                            <div class="product-at">
                                <a href="http://localhost/Shopping/chi-tiet/{{$sp_moi[$i]->cate_alias}}/{{$sp_moi[$i]->alias}}">
                                    <img class="pro-img" src="{{url("/public/products")}}/{{$sp_moi[$i]->img1}}"
                                         alt="{{$sp_moi[$i]->name}}">
                                    <!--  <div class="pro-grid">
                                          <span class="buy-in">Chi tiết</span>
                                      </div>-->
                                </a>
                            </div>
                            @if($sp_moi[$i]->percent>0)  <p class="percent"> {{$sp_moi[$i]->percent}} %</p> @endif
                            <p class="brand"> Hãng sp </p>

                            <p class="cate">{{$sp_moi[$i]->cate}}</p>


                            <p class="code">{{$sp_moi[$i]->id}}</p>

                            <p class="tun"> {{$sp_moi[$i]->name}}</p>

                            <p class="price">
                                @if($sp_moi[$i]->percent>0)
                                    <del>{{number_format($sp_moi[$i]->price)}}</del> @endif
                                {{number_format($sp_moi[$i]->price *(100-$sp_moi[$i]->percent)/100 )}}
                            </p>

                        </div>
                    @endfor
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="title_corner"><h3 class="words2">BÁN CHẠY</h3></div>
            <div class="product1">
                <div class=" bottom-product">
                    @for ($i=0;$i<count($sp_banchay);$i++)
                        <div class="bottom-cd simpleCart_shelfItem">
                            <div class="product-at">
                                <a href="http://localhost/Shopping/chi-tiet/{{$sp_banchay[$i]->cate_alias}}/{{$sp_banchay[$i]->alias}}">
                                    <img class="pro-img" src="{{url("/public/products")}}/{{$sp_banchay[$i]->img1}}"
                                         alt="{{$sp_banchay[$i]->name}}">
                                    <!--  <div class="pro-grid">
                                          <span class="buy-in">Chi tiết</span>
                                      </div>-->
                                </a>
                            </div>
                            @if($sp_banchay[$i]->percent>0)  <p class="percent"> {{$sp_banchay[$i]->percent}} %</p> @endif
                            <p class="brand"> Hãng sp </p>

                            <p class="cate">{{$sp_banchay[$i]->cate}}</p>


                            <p class="code">{{$sp_banchay[$i]->id}}</p>

                            <p class="tun"> {{$sp_banchay[$i]->name}}</p>

                            <p class="price">
                                @if($sp_banchay[$i]->percent>0)
                                    <del>{{number_format($sp_banchay[$i]->price)}}</del> @endif
                                {{number_format($sp_banchay[$i]->price *(100-$sp_banchay[$i]->percent)/100 )}}
                            </p>

                        </div>
                    @endfor
                </div>


                </div>
            </div>
            <div class="clearfix"></div>
            <div class="title_corner"><h3 class="words2">MỸ PHẨM</h3></div>
            <div class="product1">
                <div class=" bottom-product">
                    @for ($i=0;$i<count($my_pham);$i++)
                        <div class="bottom-cd simpleCart_shelfItem">
                            <div class="product-at">
                                <a href="http://localhost/Shopping/chi-tiet/{{$my_pham[$i]->cate_alias}}/{{$my_pham[$i]->alias}}">
                                    <img class="pro-img" src="{{url("/public/products")}}/{{$my_pham[$i]->img1}}"
                                         alt="{{$my_pham[$i]->name}}">
                                    <!--  <div class="pro-grid">
                                          <span class="buy-in">Chi tiết</span>
                                      </div>-->
                                </a>
                            </div>
                            @if($my_pham[$i]->percent>0)  <p class="percent"> {{$my_pham[$i]->percent}} %</p> @endif
                            <p class="brand"> Hãng sp </p>

                            <p class="cate">{{$my_pham[$i]->cate}}</p>


                            <p class="code">{{$my_pham[$i]->id}}</p>

                            <p class="tun"> {{$my_pham[$i]->name}}</p>

                            <p class="price">
                                @if($my_pham[$i]->percent>0)
                                    <del>{{number_format($my_pham[$i]->price)}}</del> @endif
                                {{number_format($my_pham[$i]->price *(100-$my_pham[$i]->percent)/100 )}}
                            </p>

                        </div>
                    @endfor
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="title_corner"><h3 class="words2">THỜI TRANG</h3></div>
            <div class="product1">
                <div class=" bottom-product">
                    @for ($i=0;$i<count($thoi_trang);$i++)
                        <div class="bottom-cd simpleCart_shelfItem">
                            <div class="product-at">
                                <a href="http://localhost/Shopping/chi-tiet/{{$thoi_trang[$i]->cate_alias}}/{{$thoi_trang[$i]->alias}}">
                                    <img class="pro-img" src="{{url("/public/products")}}/{{$thoi_trang[$i]->img1}}"
                                         alt="{{$thoi_trang[$i]->name}}">
                                    <!--  <div class="pro-grid">
                                          <span class="buy-in">Chi tiết</span>
                                      </div>-->
                                </a>
                            </div>
                            @if($thoi_trang[$i]->percent>0)  <p class="percent"> {{$thoi_trang[$i]->percent}} %</p> @endif
                            <p class="brand"> Hãng sp </p>

                            <p class="cate">{{$thoi_trang[$i]->cate}}</p>


                            <p class="code">{{$thoi_trang[$i]->id}}</p>

                            <p class="tun"> {{$thoi_trang[$i]->name}}</p>

                            <p class="price">
                                @if($thoi_trang[$i]->percent>0)
                                    <del>{{number_format($thoi_trang[$i]->price)}}</del> @endif
                                {{number_format($thoi_trang[$i]->price *(100-$thoi_trang[$i]->percent)/100 )}}
                            </p>

                        </div>
                    @endfor
                </div>

            </div>
            <div class="clearfix"></div>

            <div class="title_corner"><h3 class="words2">SỨC KHỎE</h3></div>
            <div class=" product1">
                <div class=" bottom-product">
                    @for ($i=0;$i<count($suc_khoe);$i++)
                        <div class="bottom-cd simpleCart_shelfItem">
                            <div class="product-at">
                                <a href="http://localhost/Shopping/chi-tiet/{{$suc_khoe[$i]->cate_alias}}/{{$suc_khoe[$i]->alias}}">
                                    <img class="pro-img" src="{{url("/public/products")}}/{{$suc_khoe[$i]->img1}}"
                                         alt="{{$suc_khoe[$i]->name}}">
                                    <!--  <div class="pro-grid">
                                          <span class="buy-in">Chi tiết</span>
                                      </div>-->
                                </a>
                            </div>
                            @if($suc_khoe[$i]->percent>0)  <p class="percent"> {{$suc_khoe[$i]->percent}} %</p> @endif
                            <p class="brand"> Hãng sp </p>

                            <p class="cate">{{$suc_khoe[$i]->cate}}</p>


                            <p class="code">{{$suc_khoe[$i]->id}}</p>

                            <p class="tun"> {{$suc_khoe[$i]->name}}</p>

                            <p class="price">
                                @if($suc_khoe[$i]->percent>0)
                                    <del>{{number_format($suc_khoe[$i]->price)}}</del> @endif
                                {{number_format($suc_khoe[$i]->price *(100-$suc_khoe[$i]->percent)/100 )}}
                            </p>

                        </div>
                    @endfor
                </div>

            </div>
            <div class="clearfix"></div>


        </div>

        <!----->

    </div>




@endsection