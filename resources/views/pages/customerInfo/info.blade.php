<div class="detail-info">
    <h4>THÔNG TIN CÁ NHÂN</h4>

    <div>
        <button class="btn-change" data-toggle="modal" data-target="#doiThongTin"> THAY ĐỔI</button>
        <table class="table borderless">
            <tr>
                <td>Họ và Tên</td>
                <td>{{Auth::user()->first_name. " " .Auth::user()->last_name}}</td>
            </tr>
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
    <?php  $i = 1;?>
    @foreach($address as $adr)
        <div class="address" id="address{{$i}}">
            <div class="close1" id="close{{$i}}" onclick="xoaDiaChi('#address{{$i}}','{{$adr->id}}')"></div>
            <button class="btn-change" data-toggle="modal" data-target="#doiDiaChi" data-customerinfoid="{{$adr->id}}"
                    data-firstname="{{$adr->first_name}}" data-lastname="{{$adr->last_name}}"
                    data-phone="{{$adr->phone}}" data-address="{{$adr->address}}" data-ward="{{$adr->ward_id}}"
                    data-district="{{$adr->district_id}}" data-province="{{$adr->province_id}}">
                THAY ĐỔI
            </button>
        <h5>Địa chỉ {{$i}}</h5>
        <div style="text-transform: capitalize">{{$adr->first_name ." ".$adr->last_name}}, {{$adr->phone}}</div>
            <div> {{$adr->address}} P.{{$adr->ward_name}}, Q.{{$adr->district_name}},
            TP.{{$adr->province_name}}</div>
    </div>

        <?php $i++; ?>
    @endforeach
    <button class="btn-add" data-toggle="modal" data-target="#themDiaChi">+ THÊM ĐỊA CHỈ MỚI</button>
</div>
<!-- Modal doi thong tin -->
<div class="modal " id="doiThongTin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">Email* </label>
                    <input type="email" readonly class="form-control" id="email" value="{{Auth::user()->email}}">
                </div>
                <div class="form-group">
                    <label for="first_name">Họ* </label>
                    <input type="text" class="form-control" id="first_name"
                           value="{{ucfirst(Auth::user()->first_name)}}">
                </div>
                <div class="form-group">
                    <label for="last_name">Tên* </label>
                    <input type="text" class="form-control" id="last_name"
                           value="{{ucfirst(Auth::user()->last_name) }}">
                </div>
                <div class="form-group">
                    <label for="gender">Giới tính* </label>
                    <select name="gender" id="gender" class="form-control">
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
                        onclick="$('#doiThongTin').modal('hide');doiThongTinCaNhan(this,$('#first_name').val(),$('#last_name').val(),$('#gender').val(),$('#birthday').val());"
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
<!-- Modal them dia chi moi -->
<div class="modal " id="themDiaChi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="thongtinthanhtoan">
                    <form action="{{route("thongtin.diachi.them")}}" name="diaChiGiaoHang" method="POST"
                          class="diachigiaohang" id="themDiaChiGiaoHang">
                        <div>
                            <div>
                                <label for="ho">Họ*</label><br>
                                <input type="text" autofocus name="firstname" required
                                       placeholder="Nhập họ" id="ho">
                            </div>
                            <div>
                                <label for="ten">Tên*</label><br>
                                <input type="text" name="lastname" required
                                       placeholder="Nhập tên" id="ten">
                            </div>
                        </div>
                        <div style="    padding-bottom: 30px;">
                            <label for="sdt">Điện Thoại*</label><br>
                            <input type="number" name="phone" required
                                   value="" id="sdt">
                        </div>
                        <div>
                            <label for="address">Địa chỉ*</label><br>
                            <input type="text" name="address" required id="address"
                                   placeholder="Ví dụ : 218 Lý Tự Trọng">
                        </div>
                        <div>
                            <label for="province">Thành Phố*</label> <br>
                            <select name="provinceID" id="province" onchange="getDistrict(this,this.value)">
                                @foreach($province as $p)
                                    <option value="{{$p->provinceid}}">{{$p->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="district">Tỉnh/Thành*</label><br>
                            <select name="districtID" id="district" onchange="getWard(this,this.value)">
                                @foreach($district as $d)
                                    <option value="{{$d->districtid}}">{{$d->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="ward">Phường/Xã*</label><br>
                            <select name="wardID" id="ward">
                                @foreach($ward as $w)
                                    <option value="{{$w->wardid}}">{{$w->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
                <div class="form-group">
                    *Mục bắt buột
                </div>
                <button type="button" onclick=" document.getElementById('themDiaChiGiaoHang').submit();"
                        class="btn btn-gray">Lưu
                </button>
                <button type="reset" data-dismiss="modal" class="btn btn-white" style="width: 52px">Huỷ</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal doi thong tin dia chi  -->
<div class="modal " id="doiDiaChi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="thongtinthanhtoan">
                    <form action="{{route("thongtin.diachi.doi")}}" name="diaChiGiaoHang" method="POST"
                          class="diachigiaohang" id="doiThongTinDiaChi">
                        <div>
                            <div>
                                <label for="firstname">Họ*</label><br>
                                <input type="text" autofocus name="firstname" required
                                       placeholder="Nhập họ" id="firstname">
                            </div>
                            <div>
                                <label for="lastname">Tên*</label><br>
                                <input type="text" name="lastname" required
                                       placeholder="Nhập tên" id="lastname">
                            </div>
                        </div>
                        <div style="    padding-bottom: 30px;">
                            <label for="phone">Điện Thoại*</label><br>
                            <input type="number" name="phone" required
                                   value="" id="phone">
                        </div>
                        <div>
                            <label for="address">Địa chỉ*</label><br>
                            <input type="text" name="address" required id="address"
                                   placeholder="Ví dụ : 218 Lý Tự Trọng">
                        </div>
                        <div>
                            <label for="province">Thành Phố*</label> <br>
                            <select name="provinceID" id="province" onchange="getDistrict(this,this.value)">
                                @foreach($province as $p)
                                    <option value="{{$p->provinceid}}">{{$p->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="district">Tỉnh/Thành*</label><br>
                            <select name="districtID" id="district" onchange="getWard(this,this.value)">
                                @foreach($district as $d)
                                    <option value="{{$d->districtid}}">{{$d->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="ward">Phường/Xã*</label><br>
                            <select name="wardID" id="ward">
                                @foreach($ward as $w)
                                    <option value="{{$w->wardid}}">{{$w->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" value="" name="customerInfoID" id="customerInfoID">
                    </form>
                </div>
                <div class="form-group">
                    *Mục bắt buột
                </div>
                <button type="button" onclick=" document.getElementById('doiThongTinDiaChi').submit();"
                        class="btn btn-gray">Lưu
                </button>
                <button type="reset" data-dismiss="modal" class="btn btn-white" style="width: 52px">Huỷ</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#doiDiaChi').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var customerInfoID = button.data('customerinfoid');// Extract info from data-* attributes
        var firstname = button.data('firstname');
        var lastname = button.data('lastname');
        var phone = button.data('phone');
        var address = button.data('address');
        var wardid = button.data('ward');

        var districtid = button.data('district');

        var provinceid = button.data('province');

        var modal = $(this);
        modal.find('form#doiThongTinDiaChi  input#customerInfoID').attr('value', customerInfoID);
        modal.find('form#doiThongTinDiaChi  input#firstname').attr('value', firstname);
        modal.find('form#doiThongTinDiaChi input#lastname').attr("value", lastname);
        modal.find('form#doiThongTinDiaChi input#address').attr("value", address);
        modal.find('form#doiThongTinDiaChi input#phone').attr("value", phone);
        modal.find('form#doiThongTinDiaChi select#province').val(provinceid).change();
        setTimeout(function () {
            modal.find('form#doiThongTinDiaChi select#district').val(districtid).change();
        }, 1500);
        setTimeout(function () {
            modal.find('form#doiThongTinDiaChi select#ward').val(wardid).change();
        }, 3000);

    });
</script>
