@extends("admin.layout")
@section("controll","Giảm giá")
@section("action","edit")
@section("content")

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
            <form action="{{URL::route("admin.discount.postEdit",$detail->id)}}" method="POST"
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
                    <div class="col-md-6">
                        @for($i=0;$i<17; $i++)
                            <br> <input @if( in_array($cateAll[$i]->id,$discountedCateID)) checked
                                        @endif type="checkbox" name="loai[]" id="{{$cateAll[$i]->id}}"
                                        value="{{$cateAll[$i]->id}}">
                            <label for="{{$cateAll[$i]->id}}">{{$cateAll[$i]->name}}</label>
                        @endfor
                    </div>
                    <div class="col-md-6">
                        @for($i=17;$i<35; $i++)
                            <br> <input @if(  in_array($cateAll[$i]->id,$discountedCateID)) checked
                                        @endif type="checkbox" name="loai[]" id="{{$cateAll[$i]->id}}"
                                        value="{{$cateAll[$i]->id}}">
                            <label for="{{$cateAll[$i]->id}}">{{$cateAll[$i]->name}}</label>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Phần Trăm (%)<span>*</span></label>
                <input class="form-control" type="text" value="{{$detail->percent}}" required="" name="percent">
            </div>
            <div class="form-group">
                <label>Miêu tả<span>*</span></label>
                <input class="form-control" type="text" value="{{$detail->description}}" required="" name="description">
            </div>
            <div class="form-group">
                <label>Ngày bắt đầu<span>*</span></label>
                <input class="form-control" required="" value="{{$detail->start}}" type="date" name="start">
            </div>
            <div class="form-group">
                <label>Ngày kết thúc<span>*</span></label>
                <input class="form-control" required="" value="{{$detail->end}}" type="date" name="end">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success col-md-6" name="submit" value="update">Cập nhật</button>
            </div>
        </form>
    </div>

@endsection