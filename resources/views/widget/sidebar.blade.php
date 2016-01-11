
<div class="aside">

    <div id="so_dien_thoai"  data-toggle="tooltip"  data-placement="left" title="0913134138">
        <img src="{{asset("public/images/phone1.png")}}" alt="so dien thoai mai mall shop"/><br>Hot Line
        <script type="text/javascript">  $('#so_dien_thoai').tooltip("show");  $('#so_dien_thoai').next().removeClass("in");</script>
    </div>

    <div id="facebook_maimall"><a href="https://www.facebook.com/shopmaimall?fref=ts" title="maimallshop" target="_blank">
            <img  src="http://localhost/Shopping/images/FB1.png" alt="mai mall facebook"/><br>Facebook</a>
    </div>

    <script type="text/javascript" src="http://localhost/Shopping/Public/js/skype.js"></script>
    <div id="SkypeButton_Call_maithianhtuyet85_1" title="skype_maimall">
        <script type="text/javascript">
            Skype.ui({
                "name": "chat",
                "element": "SkypeButton_Call_maithianhtuyet85_1",
                "participants": ["maithianhtuyet85"],
                "imageSize": 32,
                "assetMarginMinimum": 5
            });
        </script>
        <script type="text/javascript">$("#skype_icon").attr("src","{{asset("public/images/sk1.png")}}");</script>
        Skype
    </div>

    <div id="zalo_maimall"  data-toggle="tooltip"  data-placement="left" title=" 0909349429" >
        <img src="{{asset("public/images/zl1.png")}}" alt="zalo mai mall"/><br>Zalo
        <script type="text/javascript">$('#zalo_maimall').tooltip("show");$('#zalo_maimall').next().removeClass("in");</script>
    </div>




    <script>
        $(document).ready(function () {

            $(window).scroll(function () {
                if($(this).scrollTop()>150)  //aside
                {
                    $('.aside').css("top","0%");
                }
                else
                    $('.aside').css("top","25%");
                if ($(this).scrollTop() > 700) {
                    $('.scrollup').fadeIn();
                } else {
                    $('.scrollup').fadeOut();
                }
            });
            $('.scrollup').click(function () {
                $("html, body").animate({
                    scrollTop: 0
                }, 700);
                return false;
            });
        });
    </script>
    <style>

    </style>
    <a  href="#top" class="scrollup" title="Về đầu trang">
        <i class="fa fa-caret-up" style="font-size: 22px;"></i>TOP
    </a>















</div>