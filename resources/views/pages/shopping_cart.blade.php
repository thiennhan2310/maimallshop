@extends("layout")
@section('title',"Giỏ Hàng")
@endsection
@section("content")
<script>
        function goBack()
        {
            window.history.go(-2);
        }
        function kiemtragiohang()
        {
            if($('input#tong_cong').attr('value')==0 )
            {
                alert('Giỏ hàng không có sản phẩm');
                event.preventDefault();
                return false;
            }
            else  return true;
        }


    </script>
    <div class="check">
        <form action="#" method="post" id="capnhat">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <hr class="border-top">
            <h4 class="cart-title">GIỎ HÀNG</h4>
            <div class="col-md-9 cart-items">
                <div class="cart-info">
                    <div >Được Cung Cấp Bởi Mai Mall ( {{countProducts()}} sản phẩm )</div>
                    <div class="fee-info">Phí Vận Chuyển: Miễn Phí</div>
                </div>
                <button name="cap_nhat" id="cap_nhat_gio_hang" class="btn ">Cập nhật</button>
                <script>
                    $('button#cap_nhat_gio_hang').click(function(){
                        $.ajax({
                                    type: 'POST',
                                    datatype: 'json',
                                    url: '{{url("/gio-hang/cap-nhat")}}',
                                    data: $('form#capnhat').serialize(),
                                    success: function (data) {
                                        window.location.reload();
                                    }
                                }
                        );
                        return false;
                    });
                </script>
                @for($i=0;$i<count($products); $i++)
                <div class="cart-header" id="cart{{$i}}">
                    <div class="close1" id="close{{$i}}"> </div>
                    <div class="cart-sec simpleCart_shelfItem">
                        <div class="cart-item cyc">
                            <div class="cart-header-info">
                                <div style="text-transform: uppercase;">Hãng SP</div>
                                <div>{{$products[$i]->cate}}</div>
                                <div>{{$products[$i]->name}}</div>
                            </div>
                            <img src="{{url("public/products/")."/".$products[$i]->img1}}" class="img-responsive" alt="{{$products[$i]->name}}"/>
                        </div>
                        <div class="cart-item-info">
                            <div id="so_luong">
                                <div >Số lượng </div>
                                <input type="number" id="so_luong{{$i}}" style="width: 37px;text-align: center; height: 31px;"
                                       value="{{$products[$i]->so_luong}}" min="0" max="99" name="so_luong/{{$products[$i]->id}}"/>
                            </div>
                            <div>
                                <div>Trọng Lượng</div>
                                <div>{{$products[$i]->size}}</div>
                            </div>
                            <div>
                                <div>Mã Sản Phẩm</div>
                                <div>{{$products[$i]->id}}</div>
                            </div>
                            <div class="don_gia">
                               @if($products[$i]->percent>0) <del>{{number_format($products[$i]->price)}} VNĐ</del> @endif
                                <div>{{number_format($products[$i]->price * (100-$products[$i]->percent)/100)}} VNĐ </div>
                            </div>
                        </div>


                        <div class="clearfix"></div>

                    </div>
                    <script>
                        $('#close{{$i}}').on('click', function(){
                            $('#cart{{$i}}').fadeOut('slow', function(){
                                $("input#so_luong{{$i}}").val("0");
                                $('input#so_luong{{$i}}').attr("value","0");
                                $('#cart{{$i}}').hide();
                            });
                        });
                    </script>
                </div>
                @endfor

        </form>
    </div>
    <div class="col-md-3 cart-total">
        <div class="discount-code">
            <div class="title">Nhập Mã Giảm Giá </div>
            <div style="display: inline-flex;height: 35px;">
                <input type="text" name="ma_giam_gia" placeholder="Nhập Mã Giảm Giá " >
                <a class="use-code" href="#" onclick="">SỬ DỤNG</a>

            </div>
        </div>
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
                <div >THÀNH TIỀN</div>
                <div id="last_price">{{number_format($total)}}</div>
                <input  type="hidden" name="tong_cong" id="tong_cong" value="{{$total}}"/>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <a class="order" onclick="return kiemtragiohang();"  href="http://www.maimallshop.com/don-hang/thong-tin-thanh-toan.html" >THANH TOÁN</a>
        <a class="continue" onclick="goBack()" style="cursor:pointer">CHỌN THÊM SẢN PHẨM</a>
    </div>

    <div class="clearfix"> </div>
</div>
@endsection




