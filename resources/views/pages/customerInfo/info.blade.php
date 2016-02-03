<div class="detail-info">
    <h4>THÔNG TIN CÁ NHÂN</h4>

    <div>
        <button class="btn-change" data-toggle="modal" data-target="#doiThongTin"> THAY ĐỔI</button>
        <table class="table borderless">
            <tr>
                <td>E-mail</td>
                <td>{{Auth::user()->email}}</td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td>{{date("d/m/Y",strtotime(Auth::user()->birthday))}}</td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td>@if(Auth::user()->gender==0) Nữ @else Nam @endif</td>
            </tr>
            <tr>
                <td>Mật Khẩu:</td>
                <td>********** <a href="#" data-toggle="modal" data-target="#doiMatKhau">THAY ĐỔI MẬT KHẨU</a></td>
            </tr>
        </table>
    </div>
</div>
<div class="address-info">
    <h4>ĐỊA CHỈ GIAO HÀNG</h4>

    <div class="address">
        <div class="close1"></div>
        <button class="btn-change"> THAY ĐỔI</button>
        <h5>Địa chỉ 1</h5>

        <div>Tô Diễm trương, 090000000</div>
        <div> 89/29B, Đường 45, KP2, P.Hiệp Bình Chánh, Q.Thủ Đức, TP.Hồ Chí Minh</div>
    </div>
    <div class="address">
        <div class="close1"></div>
        <button class="btn-change"> THAY ĐỔI</button>
        <h5>Địa chỉ 2</h5>

        <div>Tô Diễm trương, 090000000</div>
        <div> 89/29B, Đường 45, KP2, P.Hiệp Bình Chánh, Q.Thủ Đức, TP.Hồ Chí Minh</div>
    </div>
    <button class="btn-add">+ THÊM ĐỊA CHỈ MỚI</button>
</div>
<!-- Modal doi thong tin -->
<div class="modal " id="doiThongTin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">Email* </label>
                    <input type="email" readonly class="form-control" id="email" placeholder="Email"
                           value="{{Auth::user()->email}}">
                </div>
                <div class="form-group">
                    <label for="gender">Giới tính* </label>
                    <select name="gender" id="gender">
                        <option @if(Auth::user()->gender==0) selected @endif value="0">Nữ</option>
                        <option @if(Auth::user()->gender==1) selected @endif value="1">Nam</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="birthday">Ngày sinh* </label>
                    <input type="date" required class="form-control" id="birthday" value="{{Auth::user()->birthday}}">
                </div>

                <div class="form-group">
                    *Mục bắt buột
                </div>
                <button type="button"
                        onclick="$('#doiThongTin').modal('hide');doiThongTinCaNhan(this,$('#gender').val(),$('#birthday').val());"
                        class="btn btn-gray">Lưu
                </button>
                <button type="reset" data-dismiss="modal" class="btn btn-white" style="width: 52px">Huỷ</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal doi password -->
<div class="modal " id="doiMatKhau" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{route("thongtin.matkhau.doi")}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="password_old">Mật khẩu hiện tại* </label>
                        <input type="password" class="form-control" name="password_old" id="password_old">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu mới* </label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Nhập lại mật khẩu * </label>
                        <input type="password" name="password_confirmation" class="form-control"
                               id="password_confirmation">
                    </div>
                    <div id="alert"></div>

                    <div class="form-group">
                        *Mục bắt buộc
                    </div>
                    <button type="submit" class="btn btn-gray">Lưu
                    </button>
                    <button type="reset" data-dismiss="modal" class="btn btn-white" style="width: 52px">Huỷ</button>
                </form>
            </div>
        </div>
    </div>
</div>
