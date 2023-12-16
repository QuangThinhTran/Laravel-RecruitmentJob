<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hệ thống nhà tuyển dụng</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="{{ url('company/plugins/fontawesome/js/all.min.js') }}"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ url('company/css/portal.css') }}">


</head>

<body class="app">
<header class="app-header fixed-top">
    <div class="app-header-inner">
        <div class="container-fluid py-2">
            <div class="app-header-content">
                <div class="row justify-content-between align-items-center">

                    <div class="col-auto">
                        <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                 role="img">
                                <title>Menu</title>
                                <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                      stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                            </svg>
                        </a>
                    </div><!--//col-->
                    <div class="search-mobile-trigger d-sm-none col">
                        <i class="search-mobile-trigger-icon fas fa-search"></i>
                    </div><!--//col-->

                    <div class="app-utilities col-auto">
                        {{--                        <div class="app-utility-item app-notifications-dropdown dropdown">--}}
                        {{--                            <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle"--}}
                        {{--                               data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"--}}
                        {{--                               title="Notifications">--}}
                        {{--                                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->--}}
                        {{--                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell icon"--}}
                        {{--                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">--}}
                        {{--                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z"/>--}}
                        {{--                                    <path fill-rule="evenodd"--}}
                        {{--                                          d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>--}}
                        {{--                                </svg>--}}
                        {{--                                <span class="icon-badge">3</span>--}}
                        {{--                            </a><!--//dropdown-toggle-->--}}

                        {{--                            <div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">--}}
                        {{--                                <div class="dropdown-menu-header p-3">--}}
                        {{--                                    <h5 class="dropdown-menu-title mb-0">Notifications</h5>--}}
                        {{--                                </div><!--//dropdown-menu-title-->--}}
                        {{--                                <div class="dropdown-menu-content">--}}
                        {{--                                    <div class="item p-3">--}}
                        {{--                                        <div class="row gx-2 justify-content-between align-items-center">--}}
                        {{--                                            <div class="col-auto">--}}
                        {{--                                                <img class="profile-image"--}}
                        {{--                                                     src="assets/images/profiles/profile-1.png" alt="">--}}
                        {{--                                            </div><!--//col-->--}}
                        {{--                                            <div class="col">--}}
                        {{--                                                <div class="info">--}}
                        {{--                                                    <div class="desc">Amy shared a file with you. Lorem ipsum dolor--}}
                        {{--                                                        sit amet, consectetur adipiscing elit.--}}
                        {{--                                                    </div>--}}
                        {{--                                                    <div class="meta"> 2 hrs ago</div>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div><!--//col-->--}}
                        {{--                                        </div><!--//row-->--}}
                        {{--                                        <a class="link-mask" href="notifications.html"></a>--}}
                        {{--                                    </div><!--//item-->--}}
                        {{--                                    <div class="item p-3">--}}
                        {{--                                        <div class="row gx-2 justify-content-between align-items-center">--}}
                        {{--                                            <div class="col-auto">--}}
                        {{--                                                <div class="app-icon-holder">--}}
                        {{--                                                    <svg width="1em" height="1em" viewBox="0 0 16 16"--}}
                        {{--                                                         class="bi bi-receipt" fill="currentColor"--}}
                        {{--                                                         xmlns="http://www.w3.org/2000/svg">--}}
                        {{--                                                        <path fill-rule="evenodd"--}}
                        {{--                                                              d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>--}}
                        {{--                                                        <path fill-rule="evenodd"--}}
                        {{--                                                              d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>--}}
                        {{--                                                    </svg>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div><!--//col-->--}}
                        {{--                                            <div class="col">--}}
                        {{--                                                <div class="info">--}}
                        {{--                                                    <div class="desc">You have a new invoice. Proin venenatis--}}
                        {{--                                                        interdum est.--}}
                        {{--                                                    </div>--}}
                        {{--                                                    <div class="meta"> 1 day ago</div>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div><!--//col-->--}}
                        {{--                                        </div><!--//row-->--}}
                        {{--                                        <a class="link-mask" href="notifications.html"></a>--}}
                        {{--                                    </div><!--//item-->--}}
                        {{--                                    <div class="item p-3">--}}
                        {{--                                        <div class="row gx-2 justify-content-between align-items-center">--}}
                        {{--                                            <div class="col-auto">--}}
                        {{--                                                <div class="app-icon-holder icon-holder-mono">--}}
                        {{--                                                    <svg width="1em" height="1em" viewBox="0 0 16 16"--}}
                        {{--                                                         class="bi bi-bar-chart-line" fill="currentColor"--}}
                        {{--                                                         xmlns="http://www.w3.org/2000/svg">--}}
                        {{--                                                        <path fill-rule="evenodd"--}}
                        {{--                                                              d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"/>--}}
                        {{--                                                    </svg>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div><!--//col-->--}}
                        {{--                                            <div class="col">--}}
                        {{--                                                <div class="info">--}}
                        {{--                                                    <div class="desc">Your report is ready. Proin venenatis interdum--}}
                        {{--                                                        est.--}}
                        {{--                                                    </div>--}}
                        {{--                                                    <div class="meta"> 3 days ago</div>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div><!--//col-->--}}
                        {{--                                        </div><!--//row-->--}}
                        {{--                                        <a class="link-mask" href="notifications.html"></a>--}}
                        {{--                                    </div><!--//item-->--}}
                        {{--                                    <div class="item p-3">--}}
                        {{--                                        <div class="row gx-2 justify-content-between align-items-center">--}}
                        {{--                                            <div class="col-auto">--}}
                        {{--                                                <img class="profile-image"--}}
                        {{--                                                     src="assets/images/profiles/profile-2.png" alt="">--}}
                        {{--                                            </div><!--//col-->--}}
                        {{--                                            <div class="col">--}}
                        {{--                                                <div class="info">--}}
                        {{--                                                    <div class="desc">James sent you a new message.</div>--}}
                        {{--                                                    <div class="meta"> 7 days ago</div>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div><!--//col-->--}}
                        {{--                                        </div><!--//row-->--}}
                        {{--                                        <a class="link-mask" href="notifications.html"></a>--}}
                        {{--                                    </div><!--//item-->--}}
                        {{--                                </div><!--//dropdown-menu-content-->--}}

                        {{--                                <div class="dropdown-menu-footer p-2 text-center">--}}
                        {{--                                    <a href="notifications.html">View all</a>--}}
                        {{--                                </div>--}}

                        {{--                            </div><!--//dropdown-menu-->--}}
                        {{--                        </div><!--//app-utility-item-->--}}

                        <div class="app-utility-item app-user-dropdown dropdown">
                            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
                               role="button" aria-expanded="false"><img
                                    src="{{ url('image_avatar') }}/{{ Auth::user()->img_avatar }}"
                                    alt="user profile"></a>
                            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                <li><a class="dropdown-item" href="{{ Route('company.profile',['id' => Auth::user()->id]) }}">Thông tin cá nhân</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ Route('company.post.create') }}">Đăng bài viết</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ Route('company.ticket.replied',['id' => Auth::user()->id])}}">Phản hồi</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ Route('home') }}">Trang chủ Finding Job</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ Route('logout') }}">Đăng xuất</a></li>
                            </ul>
                        </div><!--//app-user-dropdown-->
                    </div><!--//app-utilities-->
                </div><!--//row-->
            </div><!--//app-header-content-->
        </div><!--//container-fluid-->
    </div><!--//app-header-inner-->
    <div id="app-sidepanel" class="app-sidepanel">
        <div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
            <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
            <div class="app-branding">
                <a class="app-logo" href=""><span class="logo-text">FINDING JOB</span></a>

            </div><!--//app-branding-->

            <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                    <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link" href="{{ Route('company.index') }}">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd"
                                              d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
										<path fill-rule="evenodd"
                                              d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
										<circle cx="3.5" cy="5.5" r=".5"/>
										<circle cx="3.5" cy="8" r=".5"/>
										<circle cx="3.5" cy="10.5" r=".5"/>
									</svg>
								</span>
                            <span class="nav-link-text">Trang chủ</span>
                        </a><!--//nav-link-->
                    </li><!--//nav-item-->
                    {{--                    <li class="nav-item has-submenu">--}}
                    {{--                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->--}}
                    {{--                        <a class="nav-link submenu-toggle" href="{{ Route('company.candidate') }}">--}}
                    {{--								<span class="nav-icon">--}}
                    {{--									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files"--}}
                    {{--                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">--}}
                    {{--										<path fill-rule="evenodd"--}}
                    {{--                                              d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>--}}
                    {{--										<path--}}
                    {{--                                            d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/>--}}
                    {{--									</svg>--}}
                    {{--								</span>--}}
                    {{--                            <span class="nav-link-text">Danh sách ứng cử viên</span>--}}
                    {{--                        </a><!--//nav-link-->--}}
                    {{--                    </li><!--//nav-item-->--}}
                    <li class="nav-item has-submenu">
                        {{--                        <a class="nav-link submenu-toggle" href="{{ Route('company.candidate') }}" data-bs-toggle="collapse"--}}
                        {{--                           data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">--}}
                        <a class="nav-link" href="{{ Route('company.candidate') }}">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd"
                                              d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
									</svg>
								</span>
                            <span class="nav-link-text">Ứng cử viên</span>
                            {{--                            <span class="submenu-arrow">--}}
                            {{--									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"--}}
                            {{--                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">--}}
                            {{--										<path fill-rule="evenodd"--}}
                            {{--                                              d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />--}}
                            {{--									</svg>--}}
                            {{--								</span><!--//submenu-arrow-->--}}
                        </a><!--//nav-link-->
                        {{--                        <div id="submenu-2" class="collapse submenu submenu-2" data-bs-parent="#menu-accordion">--}}
                        {{--                            <ul class="submenu-list list-unstyled">--}}
                        {{--                                <li class="submenu-item"><a class="submenu-link" href="{{ Route('company.candidate',['major' => 'IT/ Công nghệ phần mềm']) }}">IT/ Công nghệ phần mềm</a></li>--}}
                        {{--                                <li class="submenu-item"><a class="submenu-link" href="{{ Route('company.candidate',['major' => 'Kế toán']) }}">Kế toán</a></li>--}}
                        {{--                                <li class="submenu-item"><a class="submenu-link" href="{{ Route('company.candidate',['major' => 'Makerting']) }}">Makerting</a></li>--}}
                        {{--                                <li class="submenu-item"><a class="submenu-link" href="{{ Route('company.candidate',['major' => 'Chế tạo máy']) }}">Chế tạo máy</a></li>--}}
                        {{--                                <li class="submenu-item"><a class="submenu-link" href="{{ Route('company.candidate',['major' => 'Điện/ Điện tử']) }}">Điện/ Điện tử</a></li>--}}
                        {{--                                <li class="submenu-item"><a class="submenu-link" href="{{ Route('company.candidate',['major' => 'Báo chí/ Truyền hình']) }}">Báo chí/ Truyền hình</a></li>--}}
                        {{--                                <li class="submenu-item"><a class="submenu-link" href="{{ Route('company.candidate',['major' => 'Bất động sản']) }}">Bất động sản</a></li>--}}
                        {{--                                <li class="submenu-item"><a class="submenu-link" href="{{ Route('company.candidate',['major' => 'Công nghệ Ô tô']) }}">Công nghệ Ô tô</a></li>--}}
                        {{--                            </ul>--}}
                        {{--                        </div>--}}
                    </li><!--//nav-item-->
                    <li class="nav-item has-submenu">
                        <a class="nav-link" href="{{ Route('company.history',['id' => Auth::user()->id]) }}">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd"
                                              d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
									</svg>
								</span>
                            <span class="nav-link-text">Lịch sử</span>
                        </a><!--//nav-link-->
                    </li>
                    <li class="nav-item has-submenu">
                        <a class="nav-link" href="{{ Route('company.review',['id' => Auth::user()->id]) }}">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi fa-bitcoin-sign"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd"
                                              d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
									</svg>
								</span>
                            <span class="nav-link-text">Đánh giá</span>
                        </a><!--//nav-link-->
                    </li>
                    <li class="nav-item">
                        <span class="nav-icon">
								</span>
                        <button class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Liên hệ
                        </button>
                    </li><!--//nav-item-->
                </ul><!--//app-menu-->
            </nav><!--//app-nav-->
        </div><!--//sidepanel-inner-->
    </div><!--//app-sidepanel-->
</header><!--//app-header-->
@include('modal.contact.index')
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        @yield('content')
        @yield('profile')
    </div>
</div>


<!-- Javascript -->
<script src="{{ url('company/plugins/popper.min.js') }}"></script>
<script src="{{ url('company/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Charts JS -->
<script src="{{ url('company/plugins/chart.js/chart.min.js') }}"></script>
<script src="{{ url('company/js/index-charts.js') }}"></script>

<!-- Page Specific JS -->
<script src="{{ url('company/js/app.js') }}"></script>

</body>

</html>
