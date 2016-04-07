@extends("admin.layout")
@section("controll","Đơn hàng")
@section("action",$action)
@section("content")

    <div class="col-md-12">
        @if( session("result") )
            <div class="alert alert-success">
                <ul>
                    <li>{{session("result")}}</li>
                </ul>
            </div>
            @endif

            <table class="table table-striped " id="bill-list">
                <thead>
                <tr>
                    <th>Mã Hoá Đơn</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Hình thức</th>
                    <th>Thời gian</th>
                    <th>Xác Nhận</th>
                    <th>Huỷ/Xoá</th>
                </tr>
                </thead>
                @foreach($bill as $item)
                    <tr>
                        <td><a href="#" data-toggle="modal" data-target="#detailBill"
                               data-billid="{{$item->id}}">{{$item->id}}</a></td>
                        <td>{{$item->last_name}}</td>
                        <td>{{number_format($item->total)}}</td>
                        <td>
                            @if($item->payment_method==3)
                                COD
                            @endif
                        </td>
                        <td>
                            {{date("d/m/Y",strtotime($item->created_at))}}
                        </td>
                        <td>
                            <a href="#" onclick="Confirm(this,'{{$item->id}}')"> <img
                                        src="{{asset("public/images/tick1.png")}}" alt=""> Xác Nhận</a>
                        </td>
                        <td>
                            <a href="#" onclick="Delete(this,'{{$item->id}}')"> <img
                                        src="{{asset("public/images/close.png")}}" alt=""> Huỷ</a>
                        </td>

                    </tr>
                @endforeach
            </table>
            <div style="text-align: center">
                {!! $bill->render() !!}
            </div>
    </div>
    <!--Modal chi tiet hoa don -->
    <div class="modal " id="detailBill" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th>Mã Sản Phẩm</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Đơn Giá</th>
                        </tr>
                        <tr id="bill-detail">

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#detailBill').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);// Button that triggered the modal
            var billId = button.data('billid');// Extract info from data-* attributes
            var modal = $(this);
            modal.find('div.modal-header').html("<h2> Chi tiết hoá đơn " + billId + "</h2>");
            var url = "{{route("admin.bill")}}" + "/detail-bill/" + billId;
            modal.find('tr#bill-detail').html("Loading...");
            $.get(url).done(function (data) {
                var data = jQuery.parseJSON(data);
                modal.find('tr#bill-detail').html(data["result"]);
            });
        });
        function Confirm(e, billID) {
            var url = "{{route("admin.bill")}}" + "/confirm-bill/" + billID;
            $.get(url).done(function (data) {
                $(e).parent().parent().remove();
            });

        }
        function Delete(e, billID) {
            var url = "{{route("admin.bill")}}" + "/delete-bill/" + billID;
            $.get(url).done(function (data) {
                $(e).parent().parent().remove();
            });

        }
    </script>
    <script>
        $(document).ready(function () {
            $("#bill-list").DataTable();
        });
    </script>
@endsection