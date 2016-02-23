<div class="panel-body">
    <div class="border-left"></div>

    <div class="cart-items">
        @foreach($products as $item)
        <div class="cart-header">
            <div class="cart-sec simpleCart_shelfItem">
                <div class="cart-item cyc">
                    <div class="cart-header-info">
                    </div>
                    <img src="{{asset("public/products")}}/{{$item->img1}}" class="img-responsive" alt=""/>
                </div>
                <div class="cart-item-info">
                    <div style="text-transform: uppercase;">{{$item->brand}}</div>
                    @if($item->cate!="Áo" && $item->cate!="Váy" && $item->cate!="Đầm"  && $item->cate!="Quần")
                        <div>{{$item->cate}}</div>
                    @endif
                    <div>{{$item->name}}</div>
                    <div>
                        <div>Mã Sản Phẩm</div>
                        <div>{{$item->id}}</div>
                    </div>
                    <div>
                        @if( $item->cate != "Áo" && $item->cate!="Váy" && $item->cate!="Đầm"  && $item->cate!="Quần")
                        <div>Trọng Lượng</div>
                            <div>{{$item->size}}</div>
                        @else
                        <div>Kích Cỡ</div>
                        <div>
                                                            <span class="product-size"
                                                                  style="padding-right: 14px;padding-left: 14px">{{$item->size}}
                                                                /span>
                        </div>
                        @endif
                    </div>
                    <div id="so_luong">
                        <div>Số lượng</div>
                        <div>{{$item->so_luong}}</div>
                    </div>
                    <div class="don_gia">
                        @if($item->percent>0)
                            <del>{{number_format($item->price)}} VNĐ</del>
                        @endif
                        <div>{{number_format($item->price*(100-$item->percent)/100)}} VNĐ</div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>


        @endforeach

    </div>
    <div class=" cart-total">

        <div class="price-details">
            <div>
                <div>TỔNG CỘNG</div>
                <div id="thanh_tien" class="total1">{{number_format($total)}} VNĐ</div>
            </div>
            <div>
                <div>PHÍ VẬN CHUYỂN</div>
                <div>Miễn Phí</div>
            </div>
            <div>
                <div>MÃ GIẢM GIÁ</div>
                <div>---</div>
            </div>
            <div class="last-price-title">
                <div>THÀNH TIỀN</div>
                <div id="last_price">{{number_format($total)}} VNĐ</div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <a class="order" href="#" onclick="window.thanhtoan.submit();">TIẾN HÀNH THANH TOÁN</a>
        <a class="continue" href="{{route("giohang")}}" style="cursor:pointer">QUAY LẠI GIỎHÀNG</a>


    </div>

    <div class="clearfix"></div>
</div>
