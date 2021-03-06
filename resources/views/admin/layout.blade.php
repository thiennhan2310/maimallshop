<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mai Mall Shop</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset("/public/css/bootstrap.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("/public/font-awsome/css/font-awesome.min.css")}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("/public/css/admin/AdminLTE.min.css")}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset("/public/css/admin/skin-blue.min.css")}}">
    <link rel="stylesheet" href="{{asset("/public/css/admin/style.css")}}">
    <!-- iCheck -->
    <!-- jQuery 2.1.4 -->
    <script src="{{asset("/public/js/jquery.min.js")}}"></script>
    <script  src="{{asset("public/js/admin/menu.js")}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset("/public/js/bootstrap.min.js")}}"></script>

    <script src="{{asset("/public/js/app.min.js")}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    <!--Data table-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/dt-1.10.11/datatables.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/t/dt/dt-1.10.11/datatables.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{URL::route("admin.home")}}" class="logo">

            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>MMS</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->

            <!-- search form -->

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">Menu</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Sản Phẩm</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class=" treeview-menu">
                        <li class=""><a href="{{URL::route("admin.product.list")}}"><i class="fa fa-circle-o"></i> Danh Sách</a></li>
                        <li class=""><a href="{{URL::route("admin.product.getAdd")}}"><i class="fa fa-circle-o"></i> Thêm</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Đơn Hàng</span>
                        @if($newBillCount>0)  <span class="label label-primary pull-right">{{$newBillCount}}</span>
                        @else
                            <i class="fa fa-angle-left pull-right"></i>
                        @endif
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route("admin.billnew.list")}}"><i class="fa fa-circle-o"></i> Mới</a></li>
                        <li><a href="{{route("admin.billdelivery.list")}}"><i class="fa fa-circle-o"></i> Chờ giao hàng</a>
                        </li>
                        <li><a href="{{route("admin.billsuccess.list")}}"><i class="fa fa-circle-o"></i> Đã Thanh
                                Toán</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Khuyến Mãi</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{URL::route("admin.discount.list")}}"><i class="fa fa-circle-o"></i> Danh Sách</a>
                        </li>
                        <li><a href="{{URL::route("admin.discount.getAdd")}}"><i class="fa fa-circle-o"></i>Thêm </a>
                        </li>
                    </ul>
                </li>


                     </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield("controll")
                <small>@yield("action")</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                @yield("content")
            </div><!-- /.row -->

        </section><!-- /.content -->
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2016 <a href="#">Trần Thiện Nhân</a>.</strong>
    </footer>

    <!-- Control Sidebar -->

</div><!-- ./wrapper -->



</body>
</html>
