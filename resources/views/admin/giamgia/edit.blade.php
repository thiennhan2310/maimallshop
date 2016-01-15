@extends("admin.layout")
@section("controll","Giảm giá")
@section("action","edit")
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
        <form action="{{URL::route("admin.product.postEdit",$product->id)}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Mã Sản Phẩm<span> {{$product->id}}</span></label>
            </div>
            <div class="form-group">
                <label>Tên Sản Phẩm<span>*</span></label>
                <input class="form-control" type="text" value="{{$product->name}}" required="" name="name"
                       placeholder="Nhập tên sản phẩm">
            </div>
            <div class="form-group">
                <label>Loại Sản Phẩm<span>*</span></label>
                <select name="cate" id="cate">
                    @foreach($cate as $item)
                        @if($item->name==$product->cate)
                            <option selected value="{{$item->id}}">{{$item->name}}</option>
                        @else
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Hãng sản phẩm<span>*</span></label>
                <input class="form-control" type="text" value="{{$product->brand}}" required="" name="brand"
                       placeholder="Nhập hãng sản phẩm">
            </div>
            <div class="form-group">
                <label>Giá<span>*</span></label>
                <input class="form-control" type="number" value="{{$product->price}}" required="" name="price"
                       placeholder="Nhập giá">
            </div>
            <div class="form-group">
                <label>Kích thước<span>*</span></label>
                <input class="form-control" required="" value="{{$product->size}}" type="text" name="size"
                       placeholder="Nhập kích thước">
            </div>
            <div class="form-group" id="img">
                <label>Hình<span>*</span></label>
                @for($i=1;$i<=4;$i++)
                    <?php $temp = "img" . $i; ?>
                    @if($product->$temp!="")
                        <div class="img-product" id="{{$temp}}">
                            <img style="" src="{{url("public/products")}}/{{$product->$temp}}"
                                 class="img-responsive img-close" alt="{{$product->$temp}}">
                            <div class="caption" id="remove{{$i}}">
                                Remove
                            </div>
                            <input type="hidden" name="currentImg[]" value="{{$product->$temp}}" >
                        </div>
                    @else
                        <input class="form-control" type="file" name="img[]">
                    @endif
                @endfor
            </div>


            <div class="form-group">
                <label>Thông tin chi tiết<span>*</span></label>
                <textarea class="form-control ckeditor" id="detail" required=""
                          name="detail">{{$product->description}}</textarea>

            </div>
            <div class="form-group">
                <label>Tình trạng<span>*</span></label>
                <select name="status" id="status">
                    @if($product->status==1)
                        <option value="1">Còn Hàng</option>
                    @else
                        <option value="0"> Hết hàng</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success col-md-6" name="submit" value="update">Cập nhật</button>
            </div>

        </form>
    </div>

    <script type="text/javascript">
        $("#remove1").click(function () {
            var name=$("#img1>img").attr("src").split("/");
            $("div#img").append('<input class="form-control" type="hidden" value="'+name[6]+'" name="imgDel[]">');
             $("#img1").remove();
            $("div#img").append('<input class="form-control" type="file" name="img[]" >');
            });
        $("#remove2").click(function () {
            var name=$("#img2>img").attr("src").split("/");
            $("div#img").append('<input class="form-control" type="hidden" value="'+name[6]+'" name="imgDel[]">');
            $("#img2").remove();
            $("div#img").append('<input class="form-control" type="file"  name="img[]" >');
        });
        $("#remove3").click(function () {
            var name=$("#img3>img").attr("src").split("/");
            $("div#img").append('<input class="form-control" type="hidden" value="'+name[6]+'" name="imgDel[]">');

            $("#img3").remove();
            $("div#img").append('<input class="form-control" type="file"  name="img[]" >');
        });
        $("#remove4").click(function () {
            var name=$("#img4>img").attr("src").split("/");
            $("div#img").append('<input class="form-control" type="hidden" value="'+name[6]+'" name="imgDel[]">');
            $("#img4").remove();
            $("div#img").append('<input class="form-control" type="file"  name="img[]" >');
        });

    </script>

@endsection