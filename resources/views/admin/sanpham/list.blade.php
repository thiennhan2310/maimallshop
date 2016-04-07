@extends("admin.layout")
@section("controll","Sản phẩm")
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
        <table class="table table-striped " id="product-list">
            <thead>
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th></th>
            <th></th>
        </tr>
            </thead>
            <tbody>
       @foreach($products as $item)
           <tr>
               <td>{{$item->id}}</td>
               <td>{{$item->name}}</td>
               <td>{{number_format($item->price)}}</td>
               <td><img src="{{url("/public/images/c2.jpg")}}" alt=""><a href="{{URL::route("admin.product.getEdit",$item->id)}}">Edit</a></td>
               <td><img src="{{url("/public/images/c3.jpg")}}" alt=""><a href="{{URL::route("admin.product.getDelete",$item->id)}}"> Delete</a></td>
           </tr>
           @endforeach
            </tbody>
    </table>
    <div style="text-align: center">
    {!! $products->render() !!}
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#product-list").DataTable();
    });
</script>


@endsection