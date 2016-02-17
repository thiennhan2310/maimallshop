<div class="panel-body">
    <div class="border-left"></div>
    <div class="account-pass">
        <div class="account-top">
            <h5 align="center" class="welcome">Welcome To Mai Mall</h5>

            <form method="post" action="{{route("login.post")}}" id="dangnhap">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div>
                    <span>Email</span>
                    <input type="text" name="email" required="" autofocus="" id='id'
                           title="Nhập ID">
                </div>
                <div>
                    <span>Mật Khẩu</span>
                    <input type="password" name="password" required="">
                </div>
                <span id="alert">@if(Session::has("result")) {{Session::get("result")}} @endif</span>
                <input type="submit" value="ĐĂNG NHẬP" name="dangnhap"><br/>
            </form>

        </div>
        <div class="clearfix"></div>
        <div class="account-bot" style="padding-bottom: 15px">
            <a href="{{route("signup")}}" id="dang_ki">Đăng Kí
                &nbsp;&nbsp;|&nbsp;&nbsp;</a>
            <a id="getpw" href="{$root}/quen-mat-khau.html">Quên Mật Khẩu?</a>
            <span></span>
        </div>
    </div>
</div>