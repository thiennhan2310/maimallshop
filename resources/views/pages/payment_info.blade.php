@extends("layout")
@section("title","THÔNG TIN THANH TOÁN")
@section("content")

    <div class="header-payment">
        <div><img src="{{asset("public/images")}}/transport.jpg" alt=""> GIAO HÀNG MIỄN PHÍ TỪ 500K</div>
        <div><img src="{{asset("public/images")}}/dollar.jpg" alt=""> THANH TOÁN KHI NHẬN HÀNG</div>
    </div>
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
    <div class="payment_info">
        <hr class="border-top">
        <h4 class="title">THANH TOÁN</h4>

        <div class="info">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default border-radius-none">
                    <div class="panel-heading my-tab @if(!Auth::check()) active @endif" role="tab" id="headingLogin">
                        <div class="image">
                            <img src="{{asset("public/images")}}/key-512.png" alt="dang nhap icon">
                        </div>
                        <h4 class="panel-title tab-signin">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#logIn"
                               aria-expanded="true" aria-controls="logIn">
                                @if(Auth::check()) ĐÃ ĐĂNG NHẬP LÀ @else ĐĂNG NHẬP @endif
                            </a>
                        </h4>

                        <div class="detail-info">
                            @if(Auth::check())
                                <div class="name">{{Auth::user()->first_name." ".Auth::user()->last_name}}</div>
                                <div class="email">{{Auth::user()->email}}</div>
                            @endif
                        </div>
                    </div>
                    @if(!Auth::check())
                        <div id="logIn" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="headingLogin">
                            <!-- Content -->
                            <script>
                                $("#headingLogin").addClass("active");
                                $("#logIn").load("{{route("thanhtoan.thongtin.dangnhap")}}");
                            </script>
                            <!------------>
                        </div>
                    @endif
                </div>
                <div class="clearfix"></div>

                <div class="panel panel-default  border-radius-none">
                    <div class="panel-heading my-tab " role="tab" id="headingAddress">
                        <div class="image">
                            <img src="{{asset("public/images")}}/location.png" alt="dang nhap icon">
                        </div>
                        <h4 class="panel-title tab-location">
                            <span>ĐỊA CHỈ GIAO HÀNG</span>
                        </h4>
                        @if(Auth::check() && is_object($address) )
                            <div class="detail-info" id="customer-info">
                                <div class="name">{{$address->first_name." ".$address->last_name}}</div>
                                <div class="address"> {{$address->address}} P.{{$address->ward_name}},
                                    Q.{{$address->district_name}},TP.{{$address->province_name}}</div>
                                <div class="phone">{{$address->phone}}</div>
                            </div>

                        @else
                            <div class="detail-info">
                                Thông tin khách hàng
                            </div>
                        @endif
                        <h4 class="configure-tab">
                            <a class="collapsed" role="button" id="configAddress">
                                CHỈNH SỬA
                            </a>
                        </h4>
                    </div>
                    @if(Auth::check())
                        <div id="address" class="panel-collapse collapse " role="tabpanel"
                             aria-labelledby="headingAddress">
                            <!-- Content -->
                            <script>
                                $("#headingLogin").removeClass("active");
                                $("#headingAddress").addClass("active");
                                $("#address").load("{{route("thanhtoan.thongtin.diachi")}}").addClass("in");
                            </script>
                            <!------------>
                        </div>
                    @endif
                </div>
                <div class="clearfix"></div>

                <div class="panel panel-default  border-radius-none">
                    <div class="panel-heading my-tab " role="tab" id="headingMethod">
                        <div class="image">
                            <img src="{{asset("public/images")}}/transport-43-128.png" alt="dang nhap icon">
                        </div>
                        <h4 class="panel-title tab-transport">
                            PHƯƠNG THỨC THANH TOÁN
                        </h4>

                        <div class="detail-info">
                            Thanh toán khi nhận hàng
                        </div>
                        <h4 class="configure-tab">
                            <a class="collapsed" id="configMethod" role="button">
                                CHỈNH SỬA
                            </a>
                        </h4>
                    </div>

                    <div id="method" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingMethod">
                        <!-- Content -->

                        <!------------>
                    </div>

                </div>
                <div class="clearfix"></div>

                <div class="panel panel-default  border-radius-none">
                    <div class="panel-heading my-tab" role="tab" id="headingPayment">
                        <div class="image">
                            <img src="{{asset("public/images")}}/check_box.png" alt="dang nhap icon">
                        </div>
                        <h4 class="panel-title tab-check">
                            KIỂM TRA VÀ ĐẶT HÀNG
                        </h4>

                        <div class="detail-info">
                            Vui lòng kiểm tra và xác nhận thông tin đơn hàng
                        </div>
                        <h4 class="configure-tab">
                            <a class="collapsed" role="button" id="configCart" href="#cart">
                                CHỈNH SỬA
                            </a>
                        </h4>
                    </div>
                    <div id="cart" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingPayment">

                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">

        $("#configAddress").click(function () {
            $(".panel-heading").removeClass("active");
            $("#login").removeClass("in");
            $("#method").removeClass("in");
            $("#cart").removeClass("in");
            $("#headingAddress").addClass("active");
            $("#address").load("{{route("thanhtoan.thongtin.diachi")}}").addClass("in");
        });
        $("#configMethod").click(function () {
            $(".panel-heading").removeClass("active");
            $("#login").removeClass("in");
            $("#address").removeClass("in");
            $("#cart").removeClass("in");
            $("#headingMethod").addClass("active");
            $("#method").load("{{route("thanhtoan.thongtin.phuongthuc")}}").addClass("in");
        });
        $("#configCart").click(function () {
            $(".panel-heading").removeClass("active");
            $("#login").removeClass("in");
            $("#address").removeClass("in");
            $("#method").removeClass("in");
            $("#headingPayment").addClass("active");
            $("#cart").load("{{route("thanhtoan.thongtin.giohang")}}").addClass("in");
        });

    </script>


@endsection