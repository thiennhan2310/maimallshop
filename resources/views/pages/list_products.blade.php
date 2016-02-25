@extends("layout")
@section('title')
     {{ $arrayCurrentCateName[0]["name"] }}
@endsection
@section("content")
    <p class="path">
        @if(isset($arrayParentName))
            @foreach($arrayParentName as $name)
        <a href="{{url("/san-pham")}}/{{str_slug($name["name"],"-")}}">{{$name["name"]}}</a>&nbsp;&gt;
            @endforeach
        @endif
       {{ $arrayCurrentCateName[0]["name"] }}
    </p>
        <div class=" product1">
            <div class=" bottom-product">
                @for ($i=0;$i<count($products);$i++)
                    <div class="bottom-cd simpleCart_shelfItem">
                        <div class="product-at">
                            <a href="{{url("/")}}/chi-tiet/{{$products[$i]->alias}}">
                                <img class="pro-img" src="{{url("/public/products")}}/{{$products[$i]->img1}}"
                                     alt="{{$products[$i]->name}}">
                                <!--  <div class="pro-grid">
                                      <span class="buy-in">Chi tiết</span>
                                  </div>-->
                            </a>
                        </div>
                        <p class="percent"> {{$products[$i]->percent}} %</p>

                        <p class="love">
                            <img src="{{url("/")}}/public/images/love.png"
                                 @if(!in_array($products[$i]->id,$lovedProductsId))style="display: inline-block"
                                 @else style="display: none" @endif id="addLove" alt="love"
                                 title="Thêm vào yêu thích"
                                 onclick="@if(Auth::check())themYeuThich(this,'{{$products[$i]->id}}'); @else window.location.replace('{{URL::route("login")}}'); @endif">
                            <img src="{{url("/")}}/public/images/love-red.png"
                                 @if( in_array($products[$i]->id,$lovedProductsId))style="display: inline-block"
                                 @else style="display: none" @endif id="delLove" alt="love" title="Bỏ yêu thích"
                                 onclick="@if(Auth::check())boYeuThich(this,'{{$products[$i]->id}}'); @else window.location.replace('{{URL::route("login")}}'); @endif">

                        </p>

                        <p class="cart" title="Thêm vào giỏ hàng">  @if($products[$i]->status==1)<img
                                    onclick="themGioHang(this,'{{$products[$i]->id}}')"
                                    src="{{url("/")}}/public/images/bag_white.png" alt="cart"> @endif</p>

                        <p class="brand"> {{$products[$i]->brand}} </p>

                        <p class="cate">{{$products[$i]->cate}}</p>


                        <p class="code">{{$products[$i]->id}}</p>

                        <p class="tun"> {{$products[$i]->name}}</p>

                        <p class="price">
                            @if($products[$i]->percent>0)
                                <del>{{number_format($products[$i]->price)}}</del> @endif
                            {{number_format($products[$i]->price *(100-$products[$i]->percent)/100 )}}
                        </p>

                    </div>
                @endfor
            </div>
        </div>
        <div style="text-align: center">
        {!! $products->render() !!}
        </div>



    @endsection