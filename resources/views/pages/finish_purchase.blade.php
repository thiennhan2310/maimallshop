@extends("layout")
@section("title","THÔNG TIN THANH TOÁN")
@section("content")
    <div class="panel" style="margin-top: 69px;
  margin-bottom: 17%;">
        <div class="panel-heading" style="color:white;background-color: #105726 ">
            <h3 class="panel-title">HÓA ĐƠN GIAO DỊCH</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <h3>THÔNG TIN KHÁC HÀNG</h3>

                <div class="col-md-3">
                    <div>Họ Tên:</div>
                    <div>Số Điện Thoai:</div>
                    <div>Địa Chỉ:</div>
                    <div>Email:</div>
                </div>
                <div class="col-md-9">
                    <div>{{$customerInfo->first_name}} {{$customerInfo->last_name}}</div>
                    <div>{{$customerInfo->phone}} </div>
                    <div>{{$customerInfo->address}} P.{{$customerInfo->ward_name}},
                        Q.{{$customerInfo->district_name}},TP.{{$customerInfo->province_name}}</div>
                    <div>{{Auth::user()->email}} </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3>THÔNG TIN HÓA ĐƠN</h3>

                <div class="col-md-4">
                    <div>Mã Hóa Đơn:</div>
                    <div>Ngày Giao Dịch:</div>
                    <div>Tổng Cộng:</div>
                </div>
                <div class="col-md-8">
                    <div>{{$billInfo->id}} </div>
                    <div>{{date("d/m/Y",strtotime($billInfo->created_at)) }} </div>
                    <div>{{$billInfo->total}} VNĐ</div>

                </div>

            </div>
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>Mã Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Đơn Giá</th>
                    </tr>
                    @foreach($billDetail as $item)
                        <tr>
                            <td>{{$item->products_id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{$item->price}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div> Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất</div>
        <a href="{{route("home")}}" style="color: blue;cursor: pointer">Quay về Trang Chủ</a>
    </div>
@endsection