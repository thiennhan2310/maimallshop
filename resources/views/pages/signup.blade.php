@extends("layout")
@section("title","Đăng kí thành viên")
@section("content")
    @if(count($errors)>0)
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach( $errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="register modal-form">
        <hr class="border-top">
        <h4>ĐĂNG KÍ</h4>

        <form method="post" action="{{route("signup.post")}}" onsubmit="return xac_nhan();" id="dangki">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <p style="text-align: right;    color: #ABADB3;">* Thông tin bắt buộc</p>

            <div>
                <span class="modal-id">Họ *</span>
                <input type="text" name="firstname" required="" value="{{old("firstname")}}" autofocus="" id='firstname'
                       placeholder="Nhập họ ">
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
            <p style="    color: #ABADB3;">Ít nhất 6 kí tự gồm chữ và số</p>

            <div>
                <span class="modal-id">Nhập lại mật khẩu *</span>
                <input type="password" name="password_confirmation " required="">
                <span id="alert"> </span>

            </div>
            <div>
                <span class="modal-id">Ngày tháng năm sinh</span>
                <input type="date" name="birthday">
            </div>
            <div>
                <span class="modal-id">Giới tính</span>
                <select name="gender" id="gender">
                    <option value="0">Nữ</option>
                    <option value="1">Nam</option>
                </select>
            </div>
            <div>
                Tôi đã đọc và đồng ý các <a href="{$root}/dieu-khoan.html" style="color: dodgerblue">điều khoản sử
                    dụng </a> của Mai Mall
            </div>
            <div>
                <input type="submit" value="GỬI" name="dangki">
            </div>
            <div>
                <input type="checkbox" value="getEmail"> Nhận các thông tin khuyến mãi qua email
            </div>
        </form>

    </div>
@endsection