@extends("index")
@section("title","Trang Chủ")
@section("content")
    <p class="path">
        @foreach($arrayParentName as $name)
        <a href="{{url("/san-pham")}}/{{str_slug($name["name"],"-")}}">{{$name["name"]}}</a>&nbsp;&gt;
            @endforeach
        <a href="#">{{ $arrayCurrentCateName[0]["name"]}}</a>
    </p>
        <div class=" product1">
            <div class=" bottom-product">
                @for ($i=0;$i<count($products);$i++)
                    <div class="bottom-cd simpleCart_shelfItem">
                        <div class="product-at">
                            <a href="http://localhost/Shopping/chi-tiet/{{$products[$i]->cate_alias}}/{{$products[$i]->alias}}">
                                <img class="pro-img" src="{{url("/public/products")}}/{{$products[$i]->img1}}"
                                     alt="{{$products[$i]->name}}">
                                <!--  <div class="pro-grid">
                                      <span class="buy-in">Chi tiết</span>
                                  </div>-->
                            </a>
                        </div>
                        @if($products[$i]->percent>0)  <p class="percent"> {{$products[$i]->percent}} %</p> @endif
                        <p class="brand"> Hãng sp </p>

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