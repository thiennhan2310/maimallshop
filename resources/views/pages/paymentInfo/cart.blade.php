<div class="panel-body">
    <div class="border-left"></div>
    {$i=count($gio_hang)}
    <div class="cart-items">
        {foreach $gio_hang as $sp}
        <div class="cart-header">
            <div class="cart-sec simpleCart_shelfItem">
                <div class="cart-item cyc">
                    <div class="cart-header-info">

                    </div>
                    <img src="{$root}/products/{$sp['hinh']}" class="img-responsive"
                         alt=""/>
                </div>
                <div class="cart-item-info">
                    <div style="text-transform: uppercase;">Hãng SP</div>
                    {if $sp["loai"]!= "Áo" && $sp["loai"]!= "Váy"&& $sp["loai"]!= "Đầm"&& $sp["loai"]!= "Quần" }
                    <div>{$sp["loai"]}</div>
                    {/if}
                    <div>{$sp['ten']}</div>
                    <div>
                        <div>Mã Sản Phẩm</div>
                        <div>{$sp['ma']}</div>
                    </div>
                    <div>
                        {if $sp["loai"]!= "Áo" && $sp["loai"]!= "Váy"&& $sp["loai"]!= "Đầm"&& $sp["loai"]!= "Quần" }
                        <div>Trọng Lượng</div>
                        <div>ABC</div>
                        {else}
                        <div>Kích Cỡ</div>
                        <div>
                                                            <span class="product-size"
                                                                  style="padding-right: 14px;padding-left: 14px">S</span>
                        </div>
                        {/if}
                    </div>
                    <div id="so_luong">
                        <div>Số lượng</div>
                        <div>{$sp['so_luong']}</div>
                    </div>
                    <div class="don_gia">
                        {if $sp["phantram"]>0}
                        <del>{number_format($sp["gia"])} VNĐ</del>
                        {/if}
                        <div>{number_format($sp['gia']*(1-$sp['phantram']/100))} VNĐ</div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>
        {$i=$i-1}

        {/foreach}

    </div>
    <div class=" cart-total">

        <div class="price-details">
            <div>
                <div>TỔNG CỘNG</div>
                <div id="thanh_tien" class="total1">{number_format($tong_cong)} VNĐ</div>
            </div>
            <div>
                <div>PHÍ VẬN CHUYỂN</div>
                <div>Miễn Phí</div>
            </div>
            <div>
                <div>MÃ GIẢM GIÁ</div>
                <div>ABC50</div>
            </div>
            <div class="last-price-title">
                <div>THÀNH TIỀN</div>
                <div id="last_price">{number_format($tong_cong)} VNĐ</div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <a class="order" href="#">TIẾN HÀNH THANH TOÁN</a>
        <a class="continue" href="{$root}/gio-hang.html" style="cursor:pointer">QUAY LẠI GIỎ
            HÀNG</a>
        <script>
            $("a.order").click(function () {

                window.thong_tin_thanh_toan.submit();
            });
        </script>

    </div>

    <div class="clearfix"></div>
</div>
