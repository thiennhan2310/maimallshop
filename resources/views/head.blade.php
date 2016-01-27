<head>
    <title>@yield("title")</title>
    <meta charset="UTF-8"/>
    <meta name="Keywords" content="hàn quốc,mỹ phẩm hàn quốc,mai mall,thời trang trẻ em, thời trang,phụ nữ,chăm sóc da,sữa rữa mặt,dầu gội,sữa tắm,
nấm sâm,kem dưỡng da,nước hoa hồng,quần,áo,giày dép,balo">
    <meta name="description" content='Shop Quần áo và Mỹ Phẩm Mai Mall - Mỹ Phẩm Xách Tay Hàn Quốc chất lượng đảm bảo, giá gốc
Bán hàng chính hãng - uy tín - chất lượng đảm bảo - giao hàng toàn quốc'/>
    <!--SEO-->
    <meta http-equiv="content-language" content="vi">
    <link rel="alternate" href="maimallshop.com" hreflang="vi"/>
    <link href="{{asset("public/css/bootstrap.css")}}" rel="stylesheet" type="text/css" media="all"/>
    {{--<link href="http://localhost/Shopping/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">--}}

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{--<script src="http://localhost/Shopping/bootstrap/dist/js/jquery-1.11.3.min.js" ></script>--}}
    <script src="{{asset("public/js/jquery.min.js")}}"></script>
    <script src="{{asset("public/js/bootstrap.min.js")}}"></script>


    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="{{asset("public/css/style.css")}}" rel="stylesheet" type="text/css" media="all"/>
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!--fonts-->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- start menu -->
    <link href="{{asset("public/css/memenu.css")}}" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="{{asset("public/js/memenu.js")}}"></script>
    <script>$(document).ready(function () {
            $(".memenu").memenu();
        });</script>
    {{--<script src="http://localhost/Shopping/Public/js/simpleCart.min.js"> </script>--}}
    <link rel="stylesheet" href="{{asset("public/font-awsome/css/font-awesome.min.css")}}"/>

    <!--File Upload -->
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <!-- message alert -->
    <script type="text/javascript" src="{{asset("public/js/notify.min.js")}}"></script>
    <!--- Fav icon-->
    <link rel="icon" href="http://localhost/Shopping/favicon2.ico"/>
    <meta property="fb:app_id" content="591679227637990">

    <script type="text/javascript">
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
    </script>
</head>

