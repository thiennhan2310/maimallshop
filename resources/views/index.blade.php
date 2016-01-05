
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
    @include("widget.banner")
</div>
<div class="content">
   @yield("content")
</div>
<div class="footer">
    @include("footer")
</div>
</body>
</html>

