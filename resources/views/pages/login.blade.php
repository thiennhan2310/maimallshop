@extends("layout")
@section("title","Đăng Nhập")
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
    <div class="account">
        <hr class="border-top">
        <h4>ĐĂNG NHẬP</h4>

        <div class="account-pass">
            <div class="account-top">

                <h5 align="center" class="welcome">Welcome To Mai Mall</h5>

                <form method="post" action="{{URL::route("login.post")}}" id="dangnhap">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div>
                        <span>Email</span>
                        <input type="text" name="email" required="" autofocus="" id='id' title="Nhập ID">
                    </div>
                    <div>
                        <span>Mật Khẩu</span>
                        <input type="password" name="password" required="">
                    </div>
                    <span id="alert">@if(Session::has("result")) {{Session::get("result")}} @endif</span>
                    <input type="submit" value="ĐĂNG NHẬP" name="dangnhap"><br/>
                    <input type="checkbox" name="remember_me" id="remember_me" value="1"> &nbsp;
                    <label for="remember_me" class="save_pw">Lưu Mật Khẩu</label>
                </form>


            </div>
            <div class="clearfix"></div>
            <div class="account-bot">
                <a href="{{route("signup")}}" id="dang_ki">Đăng Kí &nbsp;&nbsp;|&nbsp;&nbsp;</a>
                <a id="getpw" href="{$root}/quen-mat-khau.html">Quên Mật Khẩu?</a>
                <span></span>
            </div>
        </div>
    </div>
@endsection