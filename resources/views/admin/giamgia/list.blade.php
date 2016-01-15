@extends("admin.layout")
@section("controll","Giảm giá")
@section("action","danh sách")
@section("content")

<div class="col-md-12">
    @if( session("result") )
        <div class="alert alert-success">
            <ul>
                <li>{{session("result")}}</li>
            </ul>
        </div>
    @endif
    <a href="{{URL::route("admin.product.getAdd")}}"><button class="btn btn-primary">Thêm sản phẩm</button></a>
    <table class="table table-striped table-bordered" >
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th></th>
            <th></th>
        </tr>
       @foreach($products as $item)
           <tr>
               <td>{{$item->id}}</td>
               <td>{{$item->name}}</td>
               <td>{{number_format($item->price)}}</td>
               <td><img src="{{url("/public/images/c2.jpg")}}" alt=""><a href="{{URL::route("admin.product.getEdit",$item->id)}}">Edit</a></td>
               <td><img src="{{url("/public/images/c3.jpg")}}" alt=""><a href="{{URL::route("admin.product.getDelete",$item->id)}}"> Delete</a></td>
           </tr>
           @endforeach
    </table>
    <div style="text-align: center">
    {!! $products->render() !!}
    </div>
</div>
    @endsection