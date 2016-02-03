@if(!Auth::check())
<div class="modal fade" id="login_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="padding-bottom: 0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <ul class="nav nav-tabs mytabs" role="tablist">
                    <li role="presentation" id="tab-home">
                        <a style="color:black" href="#home" aria-controls="home"
                           role="tab" data-toggle="tab">Đăng Nhập</a>
                    </li>
                    <li role="presentation" id="tab-profile"><a href="#profile" style="color:black"
                                                                aria-controls="profile" role="tab" data-toggle="tab">Đăng
                            Kí</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane  modal-form " id="home">
                        <form method="post" action="{{URL::route("login.post")}}" id="dangnhap">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div>
                                <span class="modal-id">Email </span>
                                <input type="text" name="email" required="" autofocus="" id='email' title="Nhập ID">
                            </div>
                            <div>
                                <span class="modal-id">Mật Khẩu </span>
                                <input type="password" name="password" required="">
                            </div>
                            <div>
                                <span class="save_pw">Lưu Mật Khẩu</span>
                                <input type="checkbox" name="remember_me" id="remember_me" value="1"> <BR>
                                <a id="getpw" href="http://localhost/Shopping/quen-mat-khau.html" class="forget_pw">Quên
                                    Mật Khẩu ?</a>
                            </div>
                            <div style="padding-top: 0;">
                                <input type="submit" value="ĐĂNG NHẬP" name="dangnhap">
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane modal-form" id="profile">
                        <form method="post" action="{{route("signup.post")}}" id="dangki">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div>
                                <span class="modal-id">Họ *</span>
                                <input type="text" name="firstname" required="" value="{{old("firstname")}}"
                                       autofocus="" id='firstname' placeholder="Nhập họ ">
                            </div>
                            <div>
                                <span class="modal-id">Tên *</span>
                                <input type="text" name="lastname" required="" value="{{old("lastname")}}" id='lastname'
                                       placeholder="Nhập  tên">
                            </div>

                            <div>
                                <span class="modal-id">Email *</span>
                                <input type="text" name="email" required="" id='email' placeholder="Nhập Email">
                            </div>
                            <div>
                                <span class="modal-id">Mật khẩu *</span>
                                <input type="password" name="password" required="" placeholder="Nhập mật khẩu">
                            </div>
                            <p style=" color: #ABADB3;">Ít nhất 6 kí tự gồm chữ và số</p>
                            <div>
                                <span class="modal-id">Nhập lại mật khẩu *</span>
                                <input type="password" name="password_confirmation" required="">
                                <span id="alert"> </span>

                            </div>
                            <div>
                                <span class="modal-id">Ngày tháng năm sinh</span>
                                <input type="date" max="2002-12-31" name="birthday">
                            </div>
                            <div>
                                <span class="modal-id">Giới tính</span>
                                <select name="gender" id="gender">
                                    <option value="0">Nữ</option>
                                    <option value="1">Nam</option>
                                </select>
                            </div>
                            <div>
                                Tôi đã đọc và đồng ý các <a href="http://localhost/Shopping/dieu-khoan.html"
                                                            style="color: dodgerblue">điều khoản sử dụng </a> của Mai
                                Mall
                            </div>
                            <div>
                                <input type="submit" value="GỬI" name="dangki">
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endif