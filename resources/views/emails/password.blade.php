<html>
<head>

</head>
<body>
<div>
    <h1 align="center" style="color: #51a62f">MAI MALL SHOP</h1>

</div>
<h2>Thông tin mật khẩu</h2>
<table cellpadding="10px" cellspacing="0px">
    <tr>
        <th>Tên Khách hàng</th>
        <td>{{$name}} </td>
    </tr>
    <tr>
        <th>Mật khẩu mới</th>
        <td>{{$new_pass}} </td>
    </tr>

</table>
<div> Sau khi đăng nhập . Bạn nên đến phần thông tin cá nhân để thay đổi lại mật khẩu theo mong muốn</div>
<a href="{{route("home")}}" style="color: blue;cursor: pointer">Tới MaimallShop</a>
</body>
</html>