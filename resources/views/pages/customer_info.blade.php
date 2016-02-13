@extends("layout")
@section("title","Thông tin khách hàng")
@section("content")
    @if(count($errors)>0)
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach( $errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="personal-info">
        <hr class="border-top">
        <h4 class="title">TÀI KHOẢN CỦA TÔI</h4>

        <div class="col-md-2">
            <div class="tab active " id="my-info">
                Tài khoản của tôi
            </div>
            <div class="tab" id="check-cart">Kiểm tra đơn hàng</div>
            <div class="tab " id="love">Yêu thích</div>
        </div>
        <div class="col-md-10" id="load">
        </div>
    </div>
    <script>
        var img_load = "<img src='{{url("/")}}/public/images/loading_spinner.gif'/>";
        $("document").ready(function () {
            $("#load").html(img_load).load("{{URL::route("thongtin")}}");
        });
        $("#my-info").click(function () {
            $("#load").html(img_load).load("{{URL::route("thongtin")}}");
            $("div.tab").each(function () {
                $(this).removeClass("active");
            });
            $(this).addClass("active");
        });
        $("#check-cart").click(function () {
            $("#load").html(img_load).load("{{URL::route("giohang")}}");
            $("div.tab").each(function () {
                $(this).removeClass("active");
            });
            $(this).addClass("active");
        });
        $("#love").click(function () {
            $("#load").html(img_load).load("{{URL::route("yeuthich")}}");
            $("div.tab").each(function () {
                $(this).removeClass("active");
            });
            $(this).addClass("active");
        });
    </script>
    <script type="text/javascript">
        //TODO chuyen 3 function nay di cho khac
        function themYeuThich(e, product_id) {
            $.get("{{URL::route("yeuthich.sanpham.them")}}" + "/" + product_id).done(function (data) {
                data = jQuery.parseJSON(data);
                $(e).css("display", "none");
                $(e).next().css("display", "inline-block");
                if (data["result"] === "Thêm yêu thích thành công") {
                    $.notify(data["result"], {globalPosition: "top left", className: "success"});
                } else {
                    $.notify(data["result"], {globalPosition: "top left", className: "error"});
                }
            });
        }
        function boYeuThich(e, product_id) {
            $.get("{{URL::route("yeuthich.sanpham.xoa")}}" + "/" + product_id).done(function () {
                $(e).css("display", "none");
                $(e).prev().css("display", "inline-block");
                $.notify("Đã bỏ yêu thích", {globalPosition: "top left", className: "warn"}
                );
            });
        }
        function themGioHang(e, product_id, count) {
            count = (count === undefined ? 1 : count );
            var url = "{{url("/gio-hang/them/")}}" + "/" + product_id + "/" + count;
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    var data = jQuery.parseJSON(data);
                    if (data['result'] === "Sản phẩm đã có trong giỏ hàng") {
                        $.notify(data['result'], {globalPosition: "top left", className: "warn"});
                    } else {
                        $.notify(data['result'], {globalPosition: "top left", className: "success"});
                        $('span#tongsoluong').html(data['tsl']);
                    }

                }
            });

        }
        function chuyenSanPhamYeuThich(event, product_id, from, to) {

            var url = '{{url("/yeu-thich/chuyen")}}' + "/" + product_id + "/" + from + "/" + to;
            var img_load = "<img src='{{url("/")}}/public/images/loading_spinner.gif'/>";
            $("#load").html(img_load);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    var data = jQuery.parseJSON(data);
                    if (data['result'] === "success") {
                        $("#load").load("{{URL::route("yeuthich")}}");
                    } else {
                        $.notify(data['result'], {globalPosition: "top left", className: "success"});
                    }
                }
            });
            return false;
        }
        function xoaSanPhamYeuThich(event, product_id, from) {
            //ToDo them confirm stage
            var url = '{{url("/yeu-thich/xoa")}}' + "/" + product_id + "/" + from;
            var img_load = "<img src='{{url("/")}}/public/images/loading_spinner.gif'/>";
            $("#load").html(img_load);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    var data = jQuery.parseJSON(data);
                    if (data['result'] === "success") {
                        $("#load").load("{{URL::route("yeuthich")}}");
                    } else {
                        $.notify(data['result'], {globalPosition: "top left", className: "warn"});
                    }
                }
            });
            return false;
        }
        function taoDanhSach(e, name) {
            var url = '{{url("/yeu-thich/tao-danh-sach")}}' + "/" + name;
            var img_load = "<img src='{{url("/")}}/public/images/loading_spinner.gif'/>";
            $("#load").html(img_load);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    var data = jQuery.parseJSON(data);
                    $("#load").load("{{URL::route("yeuthich")}}");

                }
            });
            return false;
        }
        function xoaDanhSach(e, id) {
            var url = '{{url("/yeu-thich/xoa-danh-sach")}}' + "/" + id;
            var img_load = "<img src='{{url("/")}}/public/images/loading_spinner.gif'/>";
            $("#load").html(img_load);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    var data = jQuery.parseJSON(data);
                    $("#load").load("{{URL::route("yeuthich")}}");
                    $.notify(data['result'], {globalPosition: "top left", className: "success"});
                }
            });
            return false;
        }
        function doiTenDanhSach(e, id, new_name) {
            var url = '{{url("/yeu-thich/doi-ten-danh-sach")}}' + "/" + id + "/" + new_name;
            var img_load = "<img src='{{url("/")}}/public/images/loading_spinner.gif'/>";
            $("#load").html(img_load);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    var data = jQuery.parseJSON(data);
                    $("#load").load("{{URL::route("yeuthich")}}");
                    if (data['result'] == "Tên danh sách đã tồn tại")
                        $.notify(data['result'], {globalPosition: "top left", className: "warn"});
                    else
                        $.notify(data['result'], {globalPosition: "top left", className: "success"});
                }
            });
            return false;
        }
        function datMacDinh(e, id) {
            var url = '{{url("/yeu-thich/danh-sach-mac-dinh")}}' + "/" + id;
            var img_load = "<img src='{{url("/")}}/public/images/loading_spinner.gif'/>";
            $("#load").html(img_load);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    $("#load").load("{{URL::route("yeuthich")}}");

                }
            });
            return false;
        }
        function doiThongTinCaNhan(e, first_name, last_name, gender, birthday) {
            var url = '{{url("/thong-tin/thay-doi")}}' + "/" + first_name + "/" + last_name + "/" + gender + "/" + birthday;
            var img_load = "<img src='{{url("/")}}/public/images/loading_spinner.gif'/>";
            $("#load").html(img_load);
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    var data = jQuery.parseJSON(data);
                    $("#load").load("{{URL::route("thongtin")}}");
                    $.notify(data['result'], {globalPosition: "top left", className: "success"});
                }
            });
            return false;
        }
        function getDistrict(e, provinceid) {
            var url = '{{url("/quan")}}' + "/" + provinceid;
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    var data = jQuery.parseJSON(data);
                    $("select#district").each(function () {
                        $(this).html(data["district"]);
                    });
                }
            });
            return false;
        }
        function getWard(e, districtid) {
            var url = '{{url("/phuong")}}' + "/" + districtid;
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    var data = jQuery.parseJSON(data);
                    $("select#ward").each(function () {
                        $(this).html(data["ward"]);
                    });
                }
            });
            return false;
        }
        function xoaDiaChi(id, customerInfoID) {
            $(id).fadeOut('slow', function () {
                var url = '{{url("/thong-tin/xoa-dia-chi")}}' + "/" + customerInfoID;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function (data) {
                        var data = jQuery.parseJSON(data);
                        $.notify(data['result'], {globalPosition: "top left", className: data["type"]});
                    }
                });
                $(this).remove();
                return false;
            });

        }
    </script>
@endsection