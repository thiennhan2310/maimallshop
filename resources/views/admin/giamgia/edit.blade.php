@extends("admin.layout")
@section("controll","Giảm giá")
@section("action","edit")
@section("content")
    <style>
        .col1 {
            float: left;
        }
    </style>
    <div class="col-md-12">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach( $errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{URL::route("admin.product.postEdit",$detail->id)}}" method="POST"
                  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label>Mã đợt giám giá<span> {{$detail->id}}</span></label>
            </div>
            <div class="form-group">
                <label>Tên đợt giảm giá<span>*</span></label>
                <input class="form-control" type="text" value="{{$detail->name}}" required="" name="name">
            </div>
            <div class="form-group">
                <label>Loại Sản Phẩm áp dụng<span>*</span></label>

                <div>
                    <div class="col1">
                        @for($i=0;$i<17; $i++)
                            <br> <input @if(array_key_exists($cateAll[$i]->id,$dicountedCate)) checked
                                        @endif type="checkbox" name="loai[]" id="{{$cateAll[$i]->id}}"
                                        value="{{$cateAll[$i]->id}}">
                            <label for="{{$cateAll[$i]->id}}">{{$cateAll[$i]->name}}</label>
                        @endfor
                    </div>
                    <div class="col2">
                        @for($i=17;$i<35; $i++)
                            <br> <input type="checkbox" name="loai[]" id="{{$cateAll[$i]->id}}"
                                        value="{{$cateAll[$i]->id}}">
                            <label for="{{$cateAll[$i]->id}}">{{$cateAll[$i]->name}}</label>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Phần Trăm (%)<span>*</span></label>
                <input class="form-control" type="text" value="{{$detail->percent}}" required="" name="brand">
            </div>
            <div class="form-group">
                <label>Miêu tả<span>*</span></label>
                <input class="form-control" type="text" value="{{$detail->description}}" required="" name="price">
            </div>
            <div class="form-group">
                <label>Ngày bắt đầu<span>*</span></label>
                <input class="form-control" required="" value="{{$detail->start}}" type="date" name="size">
            </div>
            <div class="form-group">
                <label>Ngày kết thúc<span>*</span></label>
                <input class="form-control" required="" value="{{$detail->end}}" type="date" name="size">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success col-md-6" name="submit" value="update">Cập nhật</button>
            </div>
        </form>
    </div>

@endsection