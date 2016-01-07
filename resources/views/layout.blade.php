
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
</body>
</html>

