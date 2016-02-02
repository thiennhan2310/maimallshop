<h4>DANH SÁCH YÊU THÍCH CỦA TÔI
    <span id="create-list" style="float:right;cursor: pointer" data-toggle="modal" data-target="#taoDanhsach">+TẠO DANH SÁCH</span>
</h4>
@foreach($loveList as $item)
<div class="list-header">
    <div class="dropdown">
        <a id="dLabel" data-target="#" href="http://example.com" data-toggle="dropdown" role="button"
           aria-haspopup="true" aria-expanded="false" style="text-transform: capitalize">
            {{$item->name}}
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" aria-labelledby="dLabel">
            <li>
                <a href="" data-toggle="modal" data-target="#doiTenDanhSach">Đổi tên</a>
            </li>
            <li><a href="">Đặt làm mặc định</a></li>
            <li><a href="">Xoá danh sách</a></li>
        </ul>
    </div>
    <div class="buy">
        <div class="border-top">
            <div class="date">NGÀY</div>
            <div class="count">SỐ LƯỢNG</div>
            <div class="price">GIÁ</div>
        </div>
        <div class="btn-buy">MUA SẢN PHẨM TRONG DANH SÁCH</div>
    </div>
    <div class="clearfix"></div>

</div>
<div class="list-body">
    @foreach($lovedProduct as $product)
        @if($product->list_id==$item->id)
    <div class="list-product-info">
        <img src="{{url("/public/products")}}/{{$product->img1}}" alt="">

        <div class="detail">
            <table class="table borderless">
                <tr>
                    <td colspan="2">HÃNG SP</td>
                </tr>
                <tr>
                    <td>Loại</td>
                    <td>{{$product->cate}}</td>
                </tr>
                <tr>
                    <td>Tên</td>
                    <td>{{$product->name}}</td>
                </tr>
                <tr>
                    <td>Mã</td>
                    <td>{{$product->id}}</td>
                </tr>
                <tr>
                    <td>Size</td>
                    <td><span class="product-size">{{$product->size}}</span></td>
                </tr>
            </table>
        </div>
        <div class="date-detail">
            {{date("d/m/Y",strtotime($product->updated_at))}}
        </div>
        <div class="count-detail">
            5
        </div>
        <div class="price-detail">
            @if($product->percent>0)
                <del>{{number_format($product->price)}} VNĐ</del>
                <i class="fa fa-long-arrow-down"></i>{{$product->percent}}%</span>
                <br>
            @endif
            {{number_format($product->price*(1-$product->percent/100))}} VNĐ
        </div>
        <div class="custom">
            <button class="btn-change" style="margin-bottom: 10px" onclick="themGioHang(this,'{{$product->id}}')">CHO
                VÀO GIỎ HÀNG
            </button>
            <div class="dropdown">
                <a id="dLabel" data-target="#" href="http://example.com" data-toggle="dropdown" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    Tuỳ chọn
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dLabel">
                    <li>Chuyển sản phẩm qua</li>
                    @foreach($loveList as $list)
                        @if($list->id!=$item->id)
                            <li><a href="#"
                                   onclick="chuyenSanPhamYeuThich(this,'{{$product->id}}','{{$item->id}}','{{$list->id}}')"
                                   style="text-transform: capitalize">{{$list->name}}</a></li>
                        @endif
                    @endforeach
                    <li role="separator" class="divider"></li>
                    <li><a href="#"
                           onclick="xoaSanPhamYeuThich(this,'{{$product->id}}','{{$item->id}}')">
                            Xoá sản phẩm</a></li>
                </ul>

            </div>
        </div>
    </div>
        @endif
    @endforeach
</div>

@endforeach


<!-- Modal tao danh sach -->
<div class="modal " id="taoDanhsach" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nameList">Tên danh sách * </label>
                    <input type="text" autofocus class="form-control" id="nameList" placeholder="Tên danh sách">
                </div>
                <div class="form-group">
                    *Mục bắt buột
                </div>
                <button type="button" onclick="$('#taoDanhsach').modal('hide');taoDanhSach($('#nameList').val())"
                        class="btn btn-gray">Lưu
                </button>
                <button type="reset" data-dismiss="modal" class="btn btn-white" style="width: 52px">Huỷ</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal doi ten -->
<div class="modal fade" id="doiTenDanhSach" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nameList">Tên mới * </label>
                    <input type="text" autofocus class="form-control" id="nameList" placeholder="Tên danh sách">
                </div>
                <button type="submit" class="btn btn-gray">Lưu</button>
                <button type="button" data-dismiss="modal" class="btn btn-white" style="width: 52px">Huỷ</button>
            </div>
        </div>
    </div>
</div>