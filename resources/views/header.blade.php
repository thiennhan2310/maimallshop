<div class="header-top">
    <div class="container">
        <div class="logo">
            <a href="{{url('/trang-chu')}}"><img src="{{url("/public/images/logo.jpg")}}" alt="Mai Mall Shop logo"></a>
        </div>
        <div class="header-left">
            <ul>
                @if(Auth::check())
                    <li>
                        <div role="presentation" class="dropdown">
                            <a id="drop5" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                Xin chào {{Auth::user()->name}}<span class="caret"></span></a>

                            <ul id="menu2" class="dropdown-menu" aria-labelledby="drop5">
                                <li><a style="color:#000;font-size: 11px" href="{{url("/thong-tin-tai-khoan")}}">
                                        <i class="fa fa-user"></i> THÔNG TIN TÀI KHOẢN</a></li>
                                <li><a style="color:#000 ;font-size: 11px" href="{{URL::route("logout")}}">
                                        <i class="fa fa-sign-out"></i> ĐĂNG XUẤT </a></li>
                            </ul>
                        </div>
                    </li>
                @else
                <li ><a href="{{url('/dang-nhap')}}" id="login">ĐĂNG NHẬP</a></li>
                <li><a  href="{{url('/dang-ki')}}" id="signup"> ĐĂNG KÍ</a></li>
                <script>
                    $('#login').click(function(event){
                        event.preventDefault();
                        $("div#home").addClass("active");
                        $("#tab-home").addClass("active");
                        $("#tab-profile").removeClass("active");
                        $("div#profile").removeClass("active");
                        $('#login_form').modal('show');

                    });
                    $('#signup').click(function(event){
                        event.preventDefault();
                        $("div#home").removeClass("active");
                        $("#tab-home").removeClass("active");
                        $("#tab-profile").addClass("active");
                        $("div#profile").addClass("active");
                        $('#login_form').modal('show');
                    });
                </script>
                @endif
                    <li>
                        <a href="{{url('/')}}/thong-tin-tai-khoan" class="love-header">
                            <span id="tongsoyeuthich">@if(Session::has("love")) {{Session::get("love")}} @else
                                    0 @endif</span>
                        </a>
                    </li>
                <li >
                    <a href="{{url('/gio-hang')}}" class="bag-header">
                            <span id="tongsoluong"> {{countProducts()}}  </span>
                    </a>
                </li>
                <li  id="search_box">
                    <form action="{{url('/tim-kiem')}}" name="tim_kiem_san_pham_theo_ten" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" value="" id="tim_kiem_ten_san_pham" name="ten_san_pham" placeholder="Tên Sản Phẩm">

                        <a href="#" onclick="if($('#tim_kiem_ten_san_pham').val()==''){
                            alert('Chưa nhập tên sản phẩm');return false;
                            }
                            else
                                    this.form.submit();">
                            <span >SEARCH</span>

                        </a>
                    </form>
                </li>


            </ul>
            <div class="clearfix"> </div>


        </div>

        <div class="clearfix"> </div>

    </div>
</div>

<div class="container">

    <div class="head-top">
    @include("widget.menu")
    </div>

</div>

<!-- Modal -->
@include("widget.login")


    
