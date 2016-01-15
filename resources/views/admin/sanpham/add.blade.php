@extends("admin.layout")
@section("controll","Sản phẩm")
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
        <form action="{{URL::route("admin.product.postAdd")}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Mã Sản Phẩm<span>*</span></label>
                <input class="form-control" type="text"required="" value="{!! old("id") !!}"name="id"
                       placeholder="Nhập mã sản phẩm">
            </div>
            <div class="form-group">
                <label>Tên Sản Phẩm<span>*</span></label>
                <input class="form-control" type="text" required="" value="{!! old("name") !!}" name="name" placeholder="Nhập tên sản phẩm">
            </div>
            <div class="form-group">
                <label>Loại Sản Phẩm<span>*</span></label>
                <select name="cate" id="cate">
                    @foreach($cate as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Hãng sản phẩm<span>*</span></label>
                <input class="form-control" type="text" value="{!! old("brand") !!}" required="" name="brand" placeholder="Nhập hãng sản phẩm">
            </div>
            <div class="form-group">
                <label>Giá<span>*</span></label>
                <input class="form-control" type="number" required="" value="{!! old("price") !!}" name="price" placeholder="Nhập giá">
            </div>
            <div class="form-group">
                <label>Kích thước<span>*</span></label>
                <input class="form-control" required="" type="text" value="{!! old("size") !!}" name="size" placeholder="Nhập kích thước">
            </div>
            <div class="form-group" id="img">
                <label>Hình<span>*</span>
                    <button type="button" class="btn btn-primary" id="them">Thêm hình</button>
                </label>
                <input class="form-control" type="file" required="" name="img[]">

                {{--<img src="{{url("/public/images/close.png")}}" alt="Close">--}}
            </div>


            <div class="form-group">
                <label>Thông tin chi tiết<span>*</span></label>
                <textarea class="form-control ckeditor" id="detail"  required="" name="detail">{!! old("detail") !!} </textarea>

            </div>
            <div class="form-group">
                <label>Tình trạng<span>*</span></label>
                <select name="status" id="status">
                    <option value="1">Còn Hàng</option>
                    <option value="0"> Hết hàng</option>
                </select>
            </div>
            <div class="form-group" >
               <button type="submit" class="btn btn-success col-md-6" name="sbumit" value="add">Thêm</button>
                <button type="reset" class="btn btn-warning col-md-6" name="reset" value="reset">Reset</button>
            </div>

        </form>
    </div>

    <script type="text/javascript">
        var i = 1;

        $("#them").click(function () {
            if (i < 4) {
                i++;
                var id="close"+i;
                $("div#img").append('<span style="float:right" id='+id + ' class="glyphicon glyphicon-remove"></span><input class="form-control" type="file" required="" name="img[]" >');
                $("#close"+i).click(function(){
                    $(this).next().remove();
                    $(this).remove();
                    i--;
                });
            }
            else {
                $("div#img").append('<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Warning!</strong> Tối đa 4 tấm hình </div>');
                $("div.alert").delay(1500).fadeOut();
            }
        });

    </script>

@endsection