
<!--A Design by Mr Bill

Author: Mr Bill

-->
<!DOCTYPE html>
<html lang="vi">
@include("head")
<body>
<div class="header">
    @include("header")
</div>
<div class="banner">
    @yield("banner")

</div>
<div class="content">
    <div class="container">
   @yield("content")
        </div>
</div>
<div class="footer">
    @include("footer")
</div>
<script type='text/javascript'>window._sbzq || function (e) {
        e._sbzq = [];
        var t = e._sbzq;
        t.push(["_setAccount", 36643]);
        var n = e.location.protocol == "https:" ? "https:" : "http:";
        var r = document.createElement("script");
        r.type = "text/javascript";
        r.async = true;
        r.src = n + "//static.subiz.com/public/js/loader.js";
        var i = document.getElementsByTagName("script")[0];
        i.parentNode.insertBefore(r, i)
    }(window);</script>
</body>
</html>

