@extends('layout.layout')
@section('index')
    </header>

<body>
    <!-- <section class="home-section section-hero overlay bg-image" id="home-section"></section> -->
    @if($posts->isNotEmpty())
        <div class="container" style="padding-top:8%">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">
                    <form action="{{ Route('search.layout.filter') }}" method="post" class="search-jobs-form">
                        @csrf
                        <div class="row mb-5">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <input type="text" class="form-control form-control-lg input-search">
                                <div class="search-ajax-result" style="background:white;">

                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <select class="selectpicker" data-style="btn-white btn-lg" data-width="30%"
                                        data-live-search="true" title="Select Region" name="major">
                                    <option>IT/ Công nghệ phần mềm</option>
                                    <option>Kế toán</option>
                                    <option>Makerting</option>
                                    <option>Chế tạo máy</option>
                                    <option>Điện/ Điện tử</option>
                                    <option>Báo chí/ Truyền hình</option>
                                    <option>Bất động sản</option>
                                    <option>Công nghệ Ô tô</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4 mb-lg-0">
                                <select class="selectpicker" data-style="btn-white btn-lg" data-width="30%"
                                        data-live-search="true" title="Select Job Type" name="working">
                                    <option>Bán thời gian</option>
                                    <option>Toàn thời gian</option>
                                    <option>Thực tập</option>
                                    <option>Làm từ xa</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4 mb-lg-0">
                                <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%"
                                        data-live-search="true" title="Select Job Type" name="position">
                                    <option>Thực tập sinh</option>
                                    <option>Nhân viên</option>
                                    <option>Phó phòng</option>
                                    <option>Trưởng phòng</option>
                                    <option>Trợ lý</option>
                                    <option>Thư ký</option>
                                    <option>Giám Đốc</option>
                                    <option>Quản lý</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4 mb-lg-0">
                                <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search">
                                    <span class="icon-search icon mr-2"></span>Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="job-listings mb-2">
                        @foreach($posts as $post)
                            <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                                <a href="{{ Route('post.detail', $post['id']) }}" data-value=""></a>
                                <div class="job-listing-logo">
                                    <img src="{{ url('image_avatar/')}}/{{ $post['user']['img_avatar'] }}"
                                         alt="Free Website Template by Free-Template.co" class="img-fluid">
                                </div>
                                <div
                                    class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                                    <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                                        <strong>{{ $post['title'] }}</strong>
                                    </div>
                                    <div class="job-listing-location custom-width w-25 mb-3 mb-sm-0">
                                        <span class="icon-room"></span> {{ $post['workplace'] }}
                                    </div>
                                    <div class="job-listing-meta custom-width w-25">
                                        <div style="display: flex;justify-content: center">
                                            <span class="badge badge-success">{{ $post['major'] }}</span>
                                        </div>

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @else
        <div class="container" style="padding-top:8%">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">
                    <h1 style="color: white"> KHÔNG TÌM THẤY NỘI DUNG</h1>
                </div>
            </div>
        </div>
        <div class="container" style="padding-top:8%">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">

                </div>
            </div>
        </div>
        <div class="container" style="padding-top:8%">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">

                </div>
            </div>
        </div>
        <div class="container" style="padding-top:8%">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">

                </div>
            </div>
        </div>
        <div class="container" style="padding-top:8%">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    @endif

    @include('layout.page-js')
    <script>
        // $("search-ajax-result").hide();

        $(".input-search").keyup(function () {

            var text = $(this).val();
            console.log(text)
            {{--var url = 'http://127.0.0.1:8000/Images/'--}}

            if (text != '') {
                $.ajax({
                    url: "{{route('search.ajax')}}?key=" + text,
                    type: 'GET',
                    success: function (res) {
                        var html = '';
                        var message = '';
                        var scroll = '';
                        console.log(res.data)
                        if (res.data != '') {
                            var pro = res.data;
                            if (pro.length >= 4) {
                                html += '<div class="Scroll">'
                                pro.forEach((function (item) {
                                    message = '<h6 class="media-heading">' + res.message + '</h6>';

                                    html += '<div class="media-body d-flex justify-content-center" >';
                                    html += '   <img src="{{ url('image_avatar/')}}/' + item.user.img_avatar + ' "class="media-object"  width="50px" height="50px">';
                                    html += '   <p style="font-size: 13px;padding: 3px"> <a href="{{env('APP_DOMAIN')}}/post/post-detail/' + item.id + ' ">' + item.title + '</a></p>';
                                    html += '</div>';
                                }))
                                html += '</div>'
                                $('.search-ajax-result').html([message, scroll, html])
                            }
                            else{
                                pro.forEach((function (item) {
                                    message = '<h6 class="media-heading">' + res.message + '</h6>';

                                    html += '<div class="media-body d-flex justify-content-center" >';
                                    html += '   <img src="{{ url('image_avatar/')}}/' + item.user.img_avatar + ' "class="media-object"  width="50px" height="50px">';
                                    html += '   <p style="font-size: 13px;padding: 3px"> <a href="{{env('APP_DOMAIN')}}/post/post-detail/' + item.id + ' ">' + item.title + '</a></p>';
                                    html += '</div>';
                                }))
                                $('.search-ajax-result').html([message, scroll, html])
                            }
                        } else {
                            html += '<h4 class="media-heading" style="color: black" > Không tìm thấy</h4>';
                            $('.search-ajax-result').html(html)
                        }
                    }
                });
            } else {
                $('.search-ajax-result').html('');
            }
        });
    </script>
    <style>
        .Scroll {
            height: 350px;
            overflow-y: scroll;
        }
    </style>
@endsection
