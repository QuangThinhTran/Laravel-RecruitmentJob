<!doctype html>
<html lang="en">

<head>
    <title>Trang chủ</title>
    @include('layout.page-css')
</head>
<!-- NAVBAR -->
<header class="site-navbar mt-3" id="top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="site-logo col-6"><a style="color:white">Finding Job</a></div>
            <nav class="mx-auto site-navigation">
                <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
                    <li><a href="{{ Route('home') }}" class="nav-link active">Trang chủ</a></li>
                    <li class="has-children">
                        <a href="{{ Route('contact.index') }}">Liên hệ</a>
                    </li>
                </ul>
            </nav>

            @if(Auth::check() && Auth::user()->role_id == 1)
                <div class="right-cta-menu text-right d-flex aligin-items-center col-6 d-none d-xl-block">
                    <div class="ml-auto">
                        <form action="{{ Route('dashboard.index') }}" method="get">
                            <button type="submit" class="btn btn-primary text-white">
                                <input type="hidden" name="admin_id" value="{{ Auth::user()->role_id }}">
                                <i class="fas fa-home"> Trở về</i>
                            </button>
                        </form>
                    </div>
                </div>
            @elseif(Auth::check() && Auth::user()->role_id == 2)
                <div class="right-cta-menu text-right d-flex aligin-items-center col-6 d-none d-xl-block">
                    <div class="ml-auto">
                        <form action="{{ Route('company.index') }}" method="get">
                            <button type="submit" class="btn btn-primary text-white">
                                {{--                                <input type="hidden" name="admin_id" value="{{ Auth::user()->role_id }}">--}}
                                <i class="fas fa-home"> Trở về</i>
                            </button>
                        </form>
                    </div>
                </div>
            @elseif(Auth::check())
                <div class="right-cta-menu text-right d-flex aligin-items-center col-6 d-none d-xl-block">
                    <div class="ml-auto">
                        <a class="btn btn-success border-width-2 d-none d-lg-inline-block " href="" role="button"
                           data-toggle="dropdown" aria-expanded="false">
                            <span class=" icon-line-profile-male"></span>
                            {{ Auth::user()->username }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ Route('profile.index',['id' => Auth::user()->id]) }}">Thông
                                tin cá nhân</a>
                            <a class="dropdown-item" href="{{ Route('logout') }}">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
                    <div class="ml-auto">
                        <a href="{{ Route('user.login') }}"
                           class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span
                                class="mr-2 icon-lock_outline"></span>Đăng nhập</a>
                        <a href="{{ Route('user.register') }}"
                           class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span
                                class="mr-2 icon-contacts"></span>Đăng kí</a>
                    </div>
                    <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span
                            class="icon-menu h3 m-0 p-0 mt-2"></span></a>
                </div>
            @endif
        </div>
    </div>


@yield('content')
@yield('detail')
@yield('index')
@yield('404')
</body>

<footer class="site-footer">
    <div class="container">
        <div class="row mb-5">
            <div class="col-6 col-md-3 mb-4 mb-md-0">
                <h3>Tìm kiếm nhiều nhất</h3>
                <ul class="list-unstyled">
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Graphic Design</a></li>
                    <li><a href="#">Web Developers</a></li>
                    <li><a href="#">Python</a></li>
                    <li><a href="#">HTML5</a></li>
                    <li><a href="#">CSS3</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-3 mb-4 mb-md-0">
                <h3>Hỗ trợ</h3>
                <ul class="list-unstyled">
                    <li><a href="#">Support</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-3 mb-4 mb-md-0">
                <h3>Thông tin liên hệ</h3>
                <div class="footer-social">
                    <a href="#"><span class="icon-facebook"></span></a>
                    <a href="#"><span class="icon-twitter"></span></a>
                    <a href="#"><span class="icon-instagram"></span></a>
                    <a href="#"><span class="icon-linkedin"></span></a>
                </div>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-12">
                <p class="copyright"><small>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved | This template is made with <i class="icon-heart text-danger"
                                                                            aria-hidden="true"></i> by <a
                            href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </small></p>
            </div>
        </div>
    </div>
</footer>
<script src="{{ url('board-master/js/bootstrap.bundle.min.js') }}"></script>
{{--@include('layout.page-js')--}}

</html>
