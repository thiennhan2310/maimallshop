<html>
<head>

</head>
<body>
<div>
    <h1 align="center" style="color: #51a62f">MAI MALL SHOP</h1>

    <h3 align="center"> Chúc mừng bạn đã mua hàng thành công</h3>
</div>
<h2>Thông tin nhân</h2>
<table cellpadding="10px" cellspacing="0px">
    <tr>
        <th>Tên Khách hàng</th>
        <td>{{$customerInfo->first_name}} {{$customerInfo->last_name}}</td>
    </tr>
    <tr>
        <th>Số điện thoại</th>
        <td>{{$customerInfo->phone}}</td>
    </tr>
    <tr>
        <th>Địa Chỉ</th>
        <td>{{$customerInfo->address}} P.{{$customerInfo->ward_name}},
            Q.{{$customerInfo->district_name}},TP.{{$customerInfo->province_name}}</td>
    </tr>
    <tr>

        <th>Email</th>
        <td>{{Auth::user()->email}}</td>
    </tr>


</table>
<h2>Thông tin đơn hàng</h2>

<div>Tổng tiền : {{$billInfo->total}}</div>
<table cellpadding="10px" cellspacing="0px">
    <tr>
        <th>Mã Sản Phẩm</th>
        <th>Tên Sản Phẩm</th>
        <th>Số Lượng</th>
        <th>Đơn Giá</th>
    </tr>
    @foreach($billDetail as $item)
        <tr>
            <td>{{$item->products_id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->amount}}</td>
            <td>{{number_format($item->price)}} VNĐ</td>
        </tr>
    @endforeach
</table>
<div> Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất</div>
<a href="{{route("home")}}" style="color: blue;cursor: pointer">Tới MaimallShop</a>
</body>
</html>