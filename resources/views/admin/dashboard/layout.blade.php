<!DOCTYPE html>
<html lang="en">

<head>
    {{--  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">--}}
    {{--  <link rel="icon" type="image/png" href="../assets/img/favicon.png">--}}
    <title>
        Hệ thống quản trị viên
    </title>
    {{--  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<link href="{{ url('profile/demo/demo.css')  }}" rel="stylesheet"/>
<link href="{{ url('profile/css/paper-dashboard.css?v=2.0.1')  }}" rel="stylesheet"/>
<link href="{{ url('profile/css/bootstrap.min.css')  }}" rel="stylesheet"/>

<body>
<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
        <div class="logo" style="text-align:center;">
            <a href="" class="simple-text logo-big" >
                <div class="logo-image-small">
                    <img src="{{ url('image_avatar/') }}/{{ Auth::user()->img_avatar }}" width="50%">
                </div>
                <!-- <p>CT</p> -->
            </a>
            <a href="https://www.creative-tim.com" class="simple-text logo-normal ">
                {{ Auth::user()->name }}
                <!-- <div class="logo-image-big">
                  <img src="../assets/img/logo-big.png">
                </div> -->
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="active ">
                    <a href="{{ Route('dashboard.index') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{--                <li class="active ">--}}
                {{--                    <a href="{{ Route('home')}}">--}}
                {{--                        <i class="nc-icon nc-app"></i>--}}
                {{--                        <p>Trang chủ Finding Job</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li>
                    <a href="{{ Route('dashboard.profile',['id' => Auth::user()->id]) }}">
                        <i class="nc-icon nc-single-02"></i>
                        <p>Thông tin cá nhân</p>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dashboard.account') }}">
                        <i class="nc-icon nc-circle-10"></i>
                        <p>Tài khoản</p>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dashboard.contact') }}">
                        <i class="nc-icon nc-chat-33"></i>
                        <p>Liên hệ</p>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dashboard.report') }}">
                        <i class="nc-icon nc-book-bookmark"></i>
                        <p>Báo cáo</p>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dashboard.information') }}">
                        <i class="nc-icon nc-bullet-list-67"></i>
                        <p>Thông tin thêm</p>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dashboard.history',['id' => Auth::user()->id]) }}">
                        <i class="nc-icon nc-book-bookmark"></i>
                        <p>Lịch sử</p>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('dashboard.register.view') }}">
                        <i class="nc-icon nc-badge"></i>
                        <p>Tạo tài khoản</p>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('logout') }}">
                        <i class="nc-icon nc-lock-circle-open"></i>
                        <p>Đăng xuất</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation" style="justify-content: flex-start!important;">
                        <div class="input-group no-border">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" style="text-decoration: none;border-radius: 8px" onclick="window.location='{{ Route('home') }}'">Trang chủ Finding Job</button>
                            </div>
                        </div>

                </div>
            </div>
        </nav>
        @yield('content')
        @yield('report')
    </div>
</div>

<script>
    $(document).ready(function () {

    });
</script>
</body>
</html>
