
<!DOCTYPE html>
<html {{isset($ngApp)?'ng-app="'.$ngApp.'"':''}}>
    <head>
        <meta charset="UTF-8">
        @section('title')
        <title>Interleave</title>
        @show
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @section('header-styles')
        {{HTML::style('assets/css/bootstrap.min.css')}}
        {{HTML::style('assets/css/font-awesome.min.css')}}
        {{HTML::style('assets/css/ionicons.min.css')}}
        {{HTML::style('assets/css/AdminLTE.css')}}
        @show
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="{{url('/')}}" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <i class="fa fa-leaf"></i> InterleaveCRM
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{Auth::user()->username}}<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                            	<li><a href="#">Profile</a></li>
                            	<li><a href="{{url('auth/logout')}}">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="{{url('/')}}">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('account/contacts')}}">
                                <i class="fa fa-users"></i> <span>Contacts</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('account/companies')}}">
                                <i class="fa fa-building-o"></i> <span>Companies</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-gears"></i> <span>Settings</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="{{url('account/users')}}">
                                        <i class="fa fa-angle-double-right"></i> Manage Users
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                	@yield('content-header')
                    
                </section>

                <!-- Main content -->
                <section class="content">
                	@yield('content')
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        @section('footer-scripts')
		{{HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js')}}
        {{HTML::script('assets/js/jquery-ui-1.10.3.min.js')}}
        {{HTML::script('assets/js/bootstrap.min.js')}}
        {{HTML::script('assets/js/plugins/iCheck/icheck.min.js')}}
		{{HTML::script('assets/js/AdminLTE/app.js')}}
		@show

    </body>
</html>