<div class="header-top">

    <div class="container">
        <div class="logo">

            <a href="http://localhost/Shopping/trang-chu.html"><img src="http://localhost/Shopping/images/logo.jpg" alt="Mai Mall Shop logo"></a>

        </div>
        <div class="header-left">
            <ul>

                <li ><a href="http://localhost/Shopping/dang-nhap.html" id="login">ĐĂNG NHẬP</a></li>
                <li><a  href="http://localhost/Shopping/dieu-khoan.html" id="signup"> ĐĂNG KÍ</a></li>
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
                <li > <a href="http://localhost/Shopping/gio-hang.html" id="bag" alt="giỏ hàng"  >
                                <span id="tongsoluong">
                                0                            </span>
                    </a>
                </li>
                <li  id="search_box">
                    <form action="http://localhost/Shopping/tim-kiem.html"
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

        <div class=" h_menu4">

            <ul class="memenu skyblue">

                <li><a class="color1" href="http://localhost/Shopping/san-pham/my-pham.html">MỸ PHẨM</a>

                    <div class="mepanel" >

                        <div class="row">
                            <div class="col1">
                                <div class="h_nav">
                                    <ul>
                                        <h4><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da.html">Chăm Sóc Da </a></h4>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da/bo-duong-da.html">Bộ Dưỡng Da</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da/kem-duong-da.html">Kem Dưỡng Da</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da/kem-chong-nang.html">Kem Chống Nắng</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da/sua-rua-mat.html">Sữa Rửa Mặt</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da/nuoc-hoa-hong.html">Nước Hoa Hồng</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da/tay-te-bao-chet.html">Tẩy Tế Bào Chết</a></li>


                                    </ul>

                                </div>

                            </div>
                            <div class="col2">
                                <div class="h_nav">
                                    <h4><a href="#"> &nbsp; </a></h4>
                                    <ul>
                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da/mat-na-duong-da.html">Mặt Nạ Dưỡng Da</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da/xit-khoang.html">Xịt Khoáng</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da/duong-the.html">Dưỡng Thể</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/cham-soc-da/sua-duong-tinh-chat-duong.html">Sữa Dưỡng/Tinh Chất Dưỡng</a></li>

                                    </ul>

                                </div>

                            </div>
                            <div class="col3">
                                <div class="h_nav">
                                    <h4><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem.html">Trang Điểm </a></h4>

                                    <ul>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/bo-my-pham.html">Bộ Mỹ Phẩm</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/bb-cream.html">BB Cream</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/kem-lot-kem-nen.html">Kem Lót + Kem Nền</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/kem-che-khuyet-diem.html">Kem Che Khuyết Điểm</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/phan-ma-hong.html">Phấn Má </a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/phan-mat.html">Phấn Mắt</a></li>

                                    </ul>

                                </div>

                            </div>
                            <div class="col4">
                                <div class="h_nav">
                                    <h4><a href="#"> &nbsp; </a></h4>

                                    <ul>
                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/mascara.html">Mascara Kẻ Mắt</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/son-moi.html">Son Môi</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/son-mong.html">Sơn Móng</a></li>

                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/hightligh.html">Hightligh</a></li>
                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/co-bong-phan.html">Cọ + Bông Phấn</a></li>
                                        <li><a href="http://localhost/Shopping/san-pham/my-pham/trang-diem/phan-phu-phan-nen.html">Phấn Phủ + Phấn Nền</a></li>


                                    </ul>

                                </div>

                            </div>



                        </div>

                    </div>

                </li>

                <li ><a class="color1" href="http://localhost/Shopping/san-pham/thoi-trang.html">THỜI TRANG</a>

                    <div class="mepanel" id="thoi_trang">

                        <div class="row">

                            <div class="col1">

                                <div class="h_nav">

                                    <ul>

                                        <li><a id="ao" href="http://localhost/Shopping/san-pham/thoi-trang/ao.html">Áo  </a></li>

                                        <li><a id="vay" href="http://localhost/Shopping/san-pham/thoi-trang/vay.html">Váy   </a></li>

                                        <li><a id="dam" href="http://localhost/Shopping/san-pham/thoi-trang/dam.html">Đầm </a></li>

                                        <li><a id="quan" href="http://localhost/Shopping/san-pham/thoi-trang/quan.html">Quần  </a></li>
                                        <li><a id="khac" href="http://localhost/Shopping/khac.html">Khác  </a></li>
                                    </ul>

                                </div>

                            </div>



                        </div>

                    </div>

                </li>

                <li><a class="color1" href="http://localhost/Shopping/san-pham/suc-khoe.html">SỨC KHỎE</a>

                    <div class="mepanel" id="suc_khoe">

                        <div class="row">

                            <div class="col1">

                                <div class="h_nav">

                                    <ul>

                                        <li><a id="4" href="http://localhost/Shopping/san-pham/suc-khoe/nam-sam.html">Nấm-Sâm </a></li>

                                        <li><a id="5" href="http://localhost/Shopping/san-pham/suc-khoe/thuoc.html">Thuốc  </a></li>

                                        <li><a id="6" href="http://localhost/Shopping/san-pham/suc-khoe/khac.html">Các Loại Khác </a></li>



                                </div>

                            </div>

                </li>

                <li><a class="color1" href="http://localhost/Shopping/san-pham/danh-sach-san-pham/new.html">SẢN PHẨM MỚI</a></li>

                <li><a class="color1" href="http://localhost/Shopping/san-pham/danh-sach-san-pham/bestsell.html">SẢN PHẨM BÁN CHẠY</a></li>

                <li><a class="color1" href="http://localhost/Shopping/san-pham/danh-sach-san-pham/sale.html" id="sale">SALE</a></li>

            </ul>

        </div>



        <div class="clearfix"> </div>

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


    
