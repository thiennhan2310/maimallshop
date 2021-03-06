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
            if ($('#last_price').text() == 0)
            {
                swal("Lỗi", "Giỏ hàng không có sản phẩm!", "error");
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
                                <div><a href="{{url("chi-tiet")."/".$products[$i]->alias}}">{{$products[$i]->name}}</a>
                                </div>
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
                                <div>Kích thước</div>
                                <div>
                                    @if(is_array($products[$i]->size))
                                        @foreach($products[$i]->size as $size)
                                            <span class="product-size">{{$size}}</span>
                                        @endforeach
                                    @else
                                        {{$products[$i]->size}}
                                    @endif
                                </div>
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
            </div>
        </form>

    <div class="col-md-3 cart-total">
        <div class="discount-code">
            <div class="title">Nhập Mã Giảm Giá </div>
            <div style="display: inline-flex;height: 35px;">
                <input type="text" id="input-code-discount" name="ma_giam_gia" placeholder="Nhập Mã Giảm Giá ">
                <a class="use-code" href="#" onclick="useDiscountCode()">SỬ DỤNG</a>

            </div>
        </div>
        <div class="price-details" id="price-details">

            <div>
                <div>TẠM TÍNH</div>
                <div id="thanh_tien" class="total1">{{number_format($subTotal)}}</div>
            </div>
            <div>
                <div>MÃ GIẢM GIÁ</div>
                <div id="code-discount">
                    {{$code}}
                </div>
            </div>
            <div>
                <div>PHÍ VẬN CHUYỂN</div>
                <div>Miễn Phí</div>
            </div>
            <div class="last-price-title">
                <div>TỔNG CỘNG</div>
                <div id="last_price">{{number_format($total)}}</div>
                <!--Kiem  tra gia tri tong cong >0 thì cho phép submit-->
                <input  type="hidden" name="tong_cong" id="tong_cong" value="{{$total}}"/>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <a class="order" onclick="return kiemtragiohang();" href="{{route("thanhtoan.thongtin")}}">THANH TOÁN</a>
        <a class="continue" href="{{ URL::previous() }}" style="cursor:pointer">CHỌN THÊM SẢN PHẨM</a>
    </div>

    <div class="clearfix"> </div>
</div>

<script>
    function useDiscountCode() {
        var code = $("#input-code-discount").val();
        if (code == "") {
            swal("Lỗi!", "Xin nhập mã giảm giá", "error")
        } else {
            var uri = "{{route("code.useCode")}}";
            swal({
                        title: "Bạn muốn sử dụng mã " + code,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#105727",
                        confirmButtonText: "Sử Dụng",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                    function () {
                        //get percent from code input
                        $.get(uri, {code: code}).done(function (data) {
                            //data : tong tien mới
                            $("#code-discount").text(code);
                            $("#last_price").text(data);
                            swal({
                                title: "Thành Công",
                                text: "Bạn đã sử dụng mã giảm giá " + code + " thành công",
                                type: "success"
                            })
                        });
                    });
        }
    }
</script>
@endsection




