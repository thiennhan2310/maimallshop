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

        <table class="table table-striped" id="discount-list">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Phần Trăm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
        <?php $i = 0; ?>
        @foreach($discount as $item)
           <tr>
               <td>{{++$i}}</td>
               <td>{{$item->name}}</td>
               <td>{{$item->percent}}</td>
               <td>{{date("d-m-Y",strtotime($item->start))}}</td>
               <td>{{date("d-m-Y",strtotime($item->end))}}</td>
               <td><img src="{{url("/public/images/c2.jpg")}}" alt=""><a
                           href="{{URL::route("admin.discount.getEdit",$item->id)}}">Edit</a></td>

               <td>
                   @if($i!=1)
                       <img src="{{url("/public/images/c3.jpg")}}" alt=""><a
                               href="{{URL::route("admin.discount.getDelete",$item->id)}}"> Delete</a>
                   @endif
               </td>
           </tr>
           @endforeach
    </table>
    <div style="text-align: center">
        {!! $discount->render() !!}
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#discount-list").DataTable();
    });
</script>

@endsection