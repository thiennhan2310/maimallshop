@extends("admin.layout")
@section("controll","Giảm Giá")
@section("action","thêm")
@section("content")

    <script src="{{asset("public/ckeditor/ckeditor.js")}}"></script>

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
            @if( session("result") )
                <div class="alert alert-success">
                    <ul>
                        <li>{{session("result")}}</li>
                    </ul>
                </div>
            @endif
            <form action="{{URL::route("admin.discount.postAdd")}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label>Tên đợt giảm giá<span>*</span></label>
                    <input class="form-control" type="text" value="" required="" name="name">
                </div>
                <div class="form-group">
                    <label>Loại Sản Phẩm áp dụng<span>*</span></label>

                    <div>
                        <div class="col-md-6">
                            @for($i=0;$i<17; $i++)
                                <br> <input type="checkbox" name="loai[]" id="{{$cateAll[$i]->id}}"
                                            value="{{$cateAll[$i]->id}}">
                                <label for="{{$cateAll[$i]->id}}">{{$cateAll[$i]->name}}</label>
                            @endfor
                        </div>
                        <div class="col-md-6">
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
                    <input class="form-control" type="number" min="0" max="100" value="" required="" name="percent">
                </div>
                <div class="form-group">
                    <label>Miêu tả<span>*</span></label>
                    <input class="form-control" type="text" value="" required="" name="description">
                </div>
                <div class="form-group">
                    <label>Ngày bắt đầu<span>*</span></label>
                    <input class="form-control" required="" value="" type="date" name="start">
                </div>
                <div class="form-group">
                    <label>Ngày kết thúc<span>*</span></label>
                    <input class="form-control" required="" value="" type="date" name="end">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success col-md-6" name="submit" value="update">Cập nhật
                    </button>
                </div>
            </form>
    </div>



@endsection