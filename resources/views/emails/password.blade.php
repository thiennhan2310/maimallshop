<html>
<head>

</head>
<body>
<div>
    <h1 align="center" style="color: #51a62f">MAI MALL SHOP</h1>

    <p>
        Theo đường dẫn dưới đây để đặt lại mật khẩu:
        <br>
        {{ url('password/reset/'.$token) }}
    </p>
</body>
</html>
