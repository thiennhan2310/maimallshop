<div class="panel-body" id="thong-tin-chinh-sua">
    <div class="border-left"></div>
    <hr class="border-top">
    <div id="thongtinchinhthuc">
        <h4 class="title">CHỌN ĐỊA CHỈ </h4>
        @if(count($address)>0)
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"
                 data-interval="false">
                <!-- Indicators -->
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php $i = 1; ?>
                    @foreach($address as $adr)
                        <div class="item @if($adr->id==Auth::user()->default_info_id) active @endif" id="address{{$i}}">
                            <div id="thong-tin-chinh-thuc">
                                <input type="hidden" name="customerInfoId" value="{{$adr->id}}">
                                <img src="{{asset("public/images")}}/c2.jpg" id="chinh-sua" alt="chinh-sua"
                                     title="chỉnh sửa" data-toggle="modal" data-target="#doiDiaChi"
                                     data-customerinfoid="{{$adr->id}}"
                                     data-firstname="{{$adr->first_name}}"
                                     data-lastname="{{$adr->last_name}}"
                                     data-phone="{{$adr->phone}}"
                                     data-address="{{$adr->address}}"
                                     data-ward="{{$adr->ward_id}}"
                                     data-district="{{$adr->district_id}}"
                                     data-province="{{$adr->province_id}}">
                                <img src="{{asset("public/images")}}/c3.jpg" id="xoa" alt="xoa"
                                     title="xoa" onclick="xoaDiaChi('#address{{$i}}','{{$adr->id}}')">

                                <div class="name">{{$adr->first_name." ".$adr->last_name}}</div>
                                <div class="address"><img style="width: 16px; height: 16px;"
                                                          src="{{asset("public/images")}}/c4.jpg" alt="dia-chi">
                                    {{$adr->address}} P.{{$adr->ward_name}}, Q.{{$adr->district_name}}
                                    ,TP.{{$adr->province_name}}
                                </div>
                                <div class="phone"><img style="width: 16px; height: 16px;"
                                                        src="{{asset("public/images")}}/c5.jpg" alt="sodienthoai">
                                    {{$adr->phone}}
                                </div>

                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>

                @if(count($address)>=2)
                        <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button"
                   data-slide="prev">
                    <span class="glyphicon glyphicon-menu-left left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button"
                   data-slide="next">
                    <span class="glyphicon glyphicon-menu-right right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                @endif
            </div>

            <div class="clearfix"></div>
        @endif
        <div class="control">
            <div class="add">
                <span class="glyphicon glyphicon-plus"></span> Thêm địa chỉ mới
            </div>
            <a class="continue" id="toMethod">TIẾP TỤC</a>
            <script>
                $("#toMethod").click(function () {
                    getAddressSelected();
                    $(".panel-heading").removeClass("active");
                    $("#headingMethod").addClass("active");
                    $("#method").load("{{route("thanhtoan.thongtin.phuongthuc")}}").addClass("in");
                    $("#address").removeClass("in").html("");
                });
            </script>
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
<!--Modal doi dia chi -->
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
    function getAddressSelected() {
        var id = $(".item.active input[type='hidden']").val();
        var token = '{{ csrf_token() }}';
        $.post('{{ route("post.thanhtoan.thongtin.diachi") }}', {
            customerInfoId: id,
            _token: token
        }).done(function (data) {
            var data = jQuery.parseJSON(data);
            $("#customer-info .name").text(data["name"]);
            $("#customer-info .address").text(data["address"]);
            $("#customer-info .phone").text(data["phone"]);
        });
    }
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
    function getDistrict(e, provinceid) {
        var url = '{{url("/quan")}}' + "/" + provinceid;
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                var data = jQuery.parseJSON(data);
                $("select#district").each(function () {
                    $(this).html(data["district"]);
                });
            }
        });
        return false;
    }
    function getWard(e, districtid) {
        var url = '{{url("/phuong")}}' + "/" + districtid;
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                var data = jQuery.parseJSON(data);
                $("select#ward").each(function () {
                    $(this).html(data["ward"]);
                });
            }
        });
        return false;
    }
    function xoaDiaChi(id, customerInfoID) {
        $(id).fadeOut('slow', function () {
            var url = '{{url("/thong-tin/xoa-dia-chi")}}' + "/" + customerInfoID;
            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    var data = jQuery.parseJSON(data);
                    $.notify(data['result'], {globalPosition: "top left", className: data["type"]});
                }
            });
            $(".item").addClass("active");
            $(this).remove();
            return false;
        });

    }
</script>
