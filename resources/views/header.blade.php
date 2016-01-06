<div class="header-top">
    <div class="container">
        <div class="logo">
            <a href="{{url('/trang-chu')}}"><img src="http://localhost/Shopping/images/logo.jpg" alt="Mai Mall Shop logo"></a>
        </div>
        <div class="header-left">
            <ul>
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
                <li >
                    <a href="{{url('/gio-hang')}}" id="bag" alt="giỏ hàng"  >
                            <span id="tongsoluong">  0  </span>
                    </a>
                </li>
                <li  id="search_box">
                    <form action="{{url('/tim-kiem')}}"
                          name="tim_kiem_san_pham_theo_ten" method="post">
                        <input type="text" value="" id="tim_kiem_ten_san_pham" name="ten_san_pham" placeholder="Tên Sản Phẩm">

                        <a href="#" onclick="if($('#tim_kiem_ten_san_pham').val()==''){
                            alert('Chưa nhập tên sản phẩm');return false;
                            }
                            else
                                    document.tim_kiem_san_pham_theo_ten.submit();">
                            <span >SEARCH</span>

                        </a>
                    </form>
                </li>


            </ul>

            <div >



            </div>

            <div class="clearfix"> </div>
            <div class="search">



            </div>

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
<div class="modal fade" id="login_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="padding-bottom: 0px">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul class="nav nav-tabs mytabs" role="tablist">
                    <li role="presentation" id="tab-home"><a style="color:black" href="#home" aria-controls="home" role="tab" data-toggle="tab">Đăng Nhập</a></li>
                    <li role="presentation" id="tab-profile"><a href="#profile"style="color:black" aria-controls="profile" role="tab" data-toggle="tab">Đăng Kí</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane  modal-form " id="home" >
                        <form method="post" action="http://localhost/Shopping/dang-nhap.html" id="dangnhap">
                            <div>
                                <span class="modal-id">Email </span>
                                <input type="text" name="email" required="" autofocus="" id='email' title="Nhập ID">
                            </div>
                            <div>
                                <span class="modal-id">Mật Khẩu </span>
                                <input type="password" name="pw" required="">
                            </div>
                            <div>
                                <span for="save_pw" class="save_pw">Lưu Mật Khẩu</span>
                                <input type="checkbox" name="save_pw" value="1"> <BR>
                                <a id="getpw" href="http://localhost/Shopping/quen-mat-khau.html" class="forget_pw">Quên Mật Khẩu ?</a>
                            </div>
                            <div style="padding-top: 0px;">
                                <input type="submit"  value="ĐĂNG NHẬP" name="dangnhap">
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane modal-form" id="profile">
                        <form method="post" action="http://localhost/Shopping/dang-ki.html" id="dangki">
                            <div>
                                <span class="modal-id">Họ tên *</span>
                                <input type="text" name="name" required="" autofocus="" id='name' title="Nhập họ tên">
                            </div>
                            <div>
                                <span class="modal-id">Email *</span>
                                <input type="text" name="email" required="" autofocus="" id='email' title="Nhập ID">
                            </div>
                            <div>
                                <span class="modal-id">Mật khẩu *</span>
                                <input type="password" name="pw1" required="">
                            </div>
                            Ít nhất 6 kí tự gồm chữ và số
                            <div>
                                <span class="modal-id">Nhập lại mật khẩu *</span>
                                <input type="password" name="pw2" required="">
                            </div>
                            <div>
                                <span class="modal-id">Ngày tháng năm sinh</span>
                                <input type="date" name="birthday" >
                            </div>
                            <div>
                                <span class="modal-id">Giới tính</span>
                                <select name="gender" id="gender">
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                </select>
                            </div>
                            <div>
                                Tôi đã đọc và đồng ý các <a href="http://localhost/Shopping/dieu-khoan.html" style="color: dodgerblue">điều khoản sử dụng </a> của Mai Mall
                            </div>
                            <div>
                                <input type="submit"  value="GỬI" name="dangki">
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


    
