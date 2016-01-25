@extends("layout")
@section("title","Thông tin khách hàng")
@section("content")
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
@endsection