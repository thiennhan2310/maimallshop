@extends("layout")
@section("title")
    {{$product->name}}
@endsection
@section("content")
    <script src="{{asset("public/js/main.js")}}"></script>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/lo_LA/sdk.js#xfbml=1&version=v2.4&appId=591679227637990";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <div class="product-price1">
        <p class="path">
            @foreach($arrayParentName as $name)
                <a href="{{url("/san-pham")}}/{{str_slug($name["name"],"-")}}">{{$name["name"]}}</a>&nbsp;&gt;
            @endforeach
            <a href="{{url("/san-pham")}}/{{str_slug($arrayCurrentCateName[0]["name"],"-")}}">{{ $arrayCurrentCateName[0]["name"] }}</a>&nbsp;&gt;
            {{$product->name}}
        </p>

        <div class="product-slide">
            <div class="flexslider ">
                <ul class="slides">
                    @for($i=1;$i<=4;$i++)
                        <?php  $hinh = "img" . $i; ?>
                        @if($product->$hinh!="")
                            <li data-thumb="{{url("/public/products/")}}/{{$product->$hinh}}" style="width: 477px">
                                <img src="{{url("/public/products/")}}/{{$product->$hinh}}" class="original"
                                     id="hinh{{$i}}"/>
                            </li>
                        @endif
                    @endfor
                </ul>
            </div>
            <!-- FlexSlider -->
            <script defer src="{{asset("public/js/jquery.flexslider.js")}}"></script>
            <link rel="stylesheet" href="{{asset("public/css/flexslider.css")}}" type="text/css" media="screen"/>
            <script>
                // Can also be used with $(document).ready()
                $(window).load(function () {
                    $('.flexslider').flexslider({
                        animation: "slide",
                        controlNav: "thumbnails",
                        pauseOnHover: "true"
                    });
                    $('button#themGiohang').click(function () {
                        var sl = $('input#soLuong').val().toString();
                        themGioHang(this, "{{$product->id}}", sl); //viet funcion o header
                        return false;
                    });

                });
            </script>
        </div>

        <div class="product-info">
            <div class="zoom" style="display:none">
                @for($i=1;$i<=4;$i++)
                    <?php  $hinh = "img" . $i; ?>
                    @if($product->$hinh!="")
                        <img src="{{url("/public/products/")}}/{{$product->$hinh}}" id="zoom{{$i}}"/>
                    @endif
                @endfor
            </div>
            <script> //zoom images
                $(".original").hover(function () {
                    var id = $(this).attr('id');
                    id = '#zoom' + id.substring(4);
                    $(".zoom").css("display", "block");
                    $(id).css("display", "block");
                    $(".original").mousemove(function (event) {
                        var left = event.pageX;
                        var top = event.pageY;
                        $(id).css('top', -(top - 550));
                        $(id).css('left', -(left - 350));

                    });
                    $(".original").mouseout(function () {
                        $(".zoom").css("display", "none");
                        $(id).css("display", "none");
                    });
                });
            </script>

            <div class="single-para ">
                <span class="brand">Hãng Sản xuất</span>
                <h5 class="item_name">{{$product->name}}</h5>

                <div class="product_info">
                    <form action="http://www.maimallshop.com/gio-hang/mua-ngay/SRM-FS-02.html" method="post">
                        <table class="table borderless">
                            @if($product->discount_percent>0)
                                <tr class="real_price">
                                    <td>&nbsp;&nbsp;</td>
                                    <td>
                                        <del>{{$product->price}}</del>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>Giá</td>
                                <td style="font-size: 18px"> {{number_format($product->price*(1-$product->percent/100))}}
                                    &nbsp;
                                    @if($product->discount_percent>0)
                                        <span class="discount"> (<i class="fa fa-arrow-down"></i>{{$product->percent}}%) </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>{{$product->id}}</td>
                            </tr>

                            <tr>
                                <td>Tình Trạng:</td>
                                <td>@if($product->status==1)Còn hàng @else Hết hàng @endif</td>
                            </tr>
                            @if($product->status==1)
                                <tr>
                                    <td>Số Lượng</td>
                                    <td>
                                        <span class="btnMinus">-</span>
                                        <input type="text" name="so_luong" id="soLuong" min="1" value="1"/>
                                        <span class="btnPlus">+</span>
                                    </td>
                                </tr>
                            @endif
                        </table>
                        @if($product->status==1)
                            <button type="button" class="btn btn-white"
                                    @if(!in_array($product->id,$lovedProductsId))style="display: inline-block"
                                    @else style="display: none"
                                    @endif onclick="@if(Auth::check())themYeuThich(this ,'{{$product->id}}') @else window.location.replace('{{URL::route("login")}}') @endif">
                                <img src="{{url("/")}}/public/images/love.png"
                                     id="addLove" alt="love" title="Thêm vào yêu thích">
                            </button>
                            <button type="button" class="btn btn-white"
                                    @if( in_array($product->id,$lovedProductsId))style="display: inline-block"
                                    @else style="display: none"
                                    @endif  onclick="@if(Auth::check())boYeuThich(this,'{{$product->id}}') @else window.location.replace('{{URL::route("login")}}') @endif">
                                <img src="{{url("/")}}/public/images/love-red.png"
                                     id="delLove" alt="love" title="Bỏ yêu thích">
                            </button>
                            <button id="themGiohang" type="button" class="btn btn-white"><img
                                        src="{{url("/")}}/public/images/bag_white.png" alt=""></button>
                            <button type="submit" class="btn btn-green">MUA NGAY</button>
                        @endif
                    </form>
                </div>


            </div>
        </div>
        <div class="clearfix"></div>


        <div class="title_corner">

            <h3> SẢN PHẨM CÙNG LOẠI </h3>

        </div>

        <div class=" bottom-product">
            @for ($i=0;$i<count($productSameCate);$i++)
                <div class="bottom-cd simpleCart_shelfItem">
                    <div class="product-at">
                        <a href="{{url("/")}}/chi-tiet/{{$productSameCate[$i]->alias}}">
                            <img class="pro-img" src="{{url("/public/products")}}/{{$productSameCate[$i]->img1}}"
                                 alt="{{$productSameCate[$i]->name}}">
                        </a>
                    </div>
                    <p class="percent"> {{$productSameCate[$i]->percent}}%</p>

                    <p class="love">
                        <img src="{{url("/")}}/public/images/love.png"
                             @if(!in_array($productSameCate[$i]->id,$lovedProductsId))style="display: inline-block"
                             @else style="display: none" @endif id="addLove" alt="love"
                             title="Thêm vào yêu thích"
                             onclick="@if(Auth::check())themYeuThich(this,'{{$productSameCate[$i]->id}}') @else window.location.replace('{{URL::route("login")}}') @endif">
                        <img src="{{url("/")}}/public/images/love-red.png"
                             @if( in_array($productSameCate[$i]->id,$lovedProductsId))style="display: inline-block"
                             @else style="display: none" @endif id="delLove" alt="love" title="Bỏ yêu thích"
                             onclick="@if(Auth::check())boYeuThich(this,'{{$productSameCate[$i]->id}}') @else window.location.replace('{{URL::route("login")}}') @endif">

                    </p>

                    <p class="cart" title="Thêm vào giỏ hàng"><img
                                onclick="themGioHang(this,'{{$productSameCate[$i]->id}}')"
                                src="{{url("/")}}/public/images/bag_white.png" alt="cart"></p>

                    <p class="brand"> Hãng sp </p>

                    <p class="cate">{{$productSameCate[$i]->cate}}</p>


                    <p class="code">{{$productSameCate[$i]->id}}</p>

                    <p class="tun"> {{$productSameCate[$i]->name}}</p>

                    <p class="price">
                        @if($productSameCate[$i]->percent>0)
                            <del>{{number_format($productSameCate[$i]->price)}}</del> @endif
                        {{number_format($productSameCate[$i]->price *(100-$productSameCate[$i]->percent)/100 )}}
                    </p>

                </div>
            @endfor
        </div>
        <div class="clearfix"></div>

    </div>


    <div class="title_corner">
        <h3 align="center">THÔNG TIN CHI TIẾT</h3>
    </div>

    <div class="info-detail">
        {!!  stripcslashes($product->description) !!}
    </div>

    <div class="clearfix"></div>
    <div class="title_corner" style="padding-top: 10px">
        <h3 align="center">BÌNH LUẬN</h3>
    </div>
    <div class="fb-comments" data-width="600" data-href="http://www.maimallshop.com/{{$product->id}}.html"
         data-width="500" data-numposts="10"></div>
    <div class="clearfix"></div>
    <script>
        var soLuong = 1;
        $(".btnMinus").click(function () {
            soLuong--;
            if (soLuong < 1) {
                alert("Số lượng Không hợp lệ");
                soLuong = 1;
            }
            $("#soLuong").val(soLuong);
        });
        $(".btnPlus").click(function () {
            soLuong++;
            $("#soLuong").val(soLuong);
        });
    </script>

@endsection
