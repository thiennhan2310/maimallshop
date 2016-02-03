<h4>SẢN PHẨM TRONG GIỎ </h4>
<div class="cart-items col-md-8">

    @for($i=0;$i<count($products); $i++)
        <div class="cart-sec simpleCart_shelfItem">
            <div class="cart-item ">
                <img src="{{asset("/public/products/")}}/{{$products[$i]->img1}}" class="img-responsive" alt="">
            </div>
            <div class="cart-item-info">
                <div style="text-transform: uppercase;">Hãng SP</div>
                <div>{{$products[$i]->cate}}</div>
                <div>{{$products[$i]->name}}</div>
                <div>
                    <div>Mã Sản Phẩm</div>
                    <div>{{$products[$i]->id}}</div>
                </div>
                <div>
                    <div>Trọng Lượng</div>
                    <div>{{$products[$i]->size}}</div>
                </div>
                <div id="so_luong">
                    <div>Số lượng</div>
                    <div>{{$products[$i]->so_luong}}</div>
                </div>
                <div class="don_gia">
                    @if($products[$i]->percent>0)
                        <del>{{number_format($products[$i]->price)}} VNĐ</del> @endif
                    <div>{{number_format($products[$i]->price * (100-$products[$i]->percent)/100)}} VNĐ</div>
                </div>
            </div>
            <div class="clearfix"></div>


        </div>
    @endfor


    </div>
<div class=" cart-total col-md-4">

        <div class="price-details">
            <div>
                <div>TỔNG CỘNG</div>
                <div id="thanh_tien" class="total1">{{number_format($total)}}</div>
            </div>
            <div>
                <div>PHÍ VẬN CHUYỂN</div>
                <div>Miễn Phí</div>
            </div>

            <div class="last-price-title">
                <div>THÀNH TIỀN</div>
                <div id="last_price">{{number_format($total)}}</div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <a class="order" href="#">TIẾN HÀNH THANH TOÁN</a>
    <a class="continue" href="{{asset("/gio-hang")}}" style="cursor:pointer">QUAY LẠI GIỎ
            HÀNG</a>


    </div>

    <div class="clearfix"></div>
