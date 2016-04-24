@extends("layout")
@section("title","Lấy lại mật khẩu")
@section("content")

    <div class="quen_mat_khau ">
        <hr class="border-top">
        <h4>QUÊN MẬT KHẨU</h4>

        <div class="welcome"> Xin vui lòng nhập địa chỉ email của bạn. Chúng tôi sẽ gửi đường link để thay đổi mật
            khẩu
        </div>

        <form align="center" action="{{ url('/password/email') }}" method="post" name="form1" id="captcha">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div>
                <span>Email</span>
                <input type="email" name="email">
            </div>
            <div style="padding-top: 40px">
                <a id="back" href="{{redirect()->back()}}">Trở Về </a>
                <input type="submit" value="Gửi">
            </div>
        </form>
        <div class="dang-ki">
            Bạn chưa là thành viên của Mai Mall? <a href="{{route("signup")}}">Đăng ký</a>
        </div>
    </div>
@endsection