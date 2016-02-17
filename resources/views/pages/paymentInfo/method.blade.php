<div class="panel-body">
    <div class="border-left"></div>
    <img src="{{asset("public/images")}}/COD.jpg" alt="COD" id="COD">

    <div class="control">
        <a class="continue" id="toPayment">TIẾP TỤC</a>
        <script>
            $("#toPayment").click(function () {
                $(".panel-heading").removeClass("active");
                $("#headingPayment").addClass("active");
                $("#cart").load("{{route("thanhtoan.thongtin.giohang")}}").addClass("in");
                $("#method").removeClass("in").html("");
            });
        </script>
    </div>
</div>