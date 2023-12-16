@extends('layout.layout')
@section('content')
    @include('sweetalert::alert')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
    <link href="{{ url('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('board-master/css/custom-bs.css') }}">
    <link rel="stylesheet" href="{{ url('board-master/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ url('board-master/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ url('board-master/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ url('board-master/fonts/line-icons/style.css') }}">
    <link rel="stylesheet" href="{{ url('board-master/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('board-master/css/animate.min.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ url('board-master/css/style.css') }}">

    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image"
             id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="custom-breadcrumbs">
                        <a href="{{ Route('home')}}">Trang chủ</a> <span class="mx-2 slash">/</span>
                        <a href="#">Job</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>{{$post->title}}</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container" style="background-color: white;padding: 10px;border-radius: 10px;">
            <div class="row align-items-center mb-3">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div class="border p-2 d-inline-block mr-3 rounded">
                            <img src="{{ url('image_avatar/')}}/{{ $post->user->img_avatar}}" width="100" height="100">
                        </div>
                        <div>
                            {{--                            <h2 style="color:black;"> </h2>--}}
                            <p style="color: black;font-weight: bold;font-size: 20px">{{ $post->title }}</p>
                            <div>
                                <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase"></span> {{ $post->user->name }}</span>
                                <span class="m-2"><span class="icon-room mr-2"></span>{{ $post->workplace }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div id="detail-post">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-light p-3 border rounded mb-4">
                        <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Chi tiết công việc</h3>
                        <ul class="list-unstyled pl-3 mb-0">
                            <li class="mb-2"><strong class="text-black">Đăng
                                    ngày</strong> {{ $post->created_at->format('d-m-Y') }}</li>
                            <li class="mb-2"><strong class="text-black" style="color:red">Số lượng
                                    :</strong> {{ $post->quantity }}</li>
                            <li class="mb-2"><strong class="text-black">Chuyên ngành:</strong> {{ $post->major }}
                            </li>
                            <li class="mb-2"><strong class="text-black">Cấp bậc:</strong> {{ $post->position }}
                            <li class="mb-2"><strong class="text-black">Kinh nghiệm:</strong> {{ $post->experience }}
                            <li class="mb-2"><strong class="text-black">Hình thức làm
                                    việc:</strong> {{ $post->working }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layout.page-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(() => {
            let _li = '';
            $.get('{{ Route('company.storage') }}?id={{$post->id}}', (res) => {
                var data = res.post;
                console.log(data.requirements)
                _li += '<div class="mb-5">';
                _li += '<h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Mô tả công việc</h3>';
                _li += data.description;
                _li += '</div>';
                _li += '<div class="mb-5">';
                _li += '<h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Lợi ích</h3>';
                _li += ' ' + data.benefit + ' </span>';
                _li += '</div>';
                _li += '<div class="mb-5">';
                _li += '<h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Yêu cầu</h3>';
                _li += ' ' + data.requirements + ' </span>';
                _li += '</div>';
                $('#detail-post').html(_li).first();
            });
        });
    </script>
@endsection
