@extends('layout.layout')
@section('index')
    </header>

<body>
    <!-- <section class="home-section section-hero overlay bg-image" id="home-section"></section> -->
    <div class="container" style="padding-top:8%">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-12">
                <form action="{{ Route('search.layout.filter') }}" method="post" class="search-jobs-form">
                    @csrf
                    <div class="row mb-5">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <input type="text" class="form-control form-control-lg input-search">
                            <div class="search-ajax-result">
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
                                <option>Cơ khí</option>
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
                            <a href="{{ Route('post.detail', $post->id) }}" data-value=""></a>
                            <div class="job-listing-logo">
                                <img src="{{ url('image_avatar/')}}/{{ $post->user->img_avatar }}"
                                     alt="Free Website Template by Free-Template.co" class="img-fluid">
                            </div>
                            <div
                                class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                                <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                                    <strong>{{ $post->title }}</strong>
                                </div>
                                <div class="job-listing-location custom-width w-25 mb-3 mb-sm-0">
                                    <span class="icon-room"></span> {{ $post->workplace }}
                                </div>
                                <div class="job-listing-meta custom-width w-25">
                                    <div style="display: flex;justify-content: center">
                                        <span class="badge badge-success">{{ $post->major }}</span>
                                    </div>

                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <section class="site-section py-4" style="background-color:white;">
        <p style="color: black;font-size: 30px;font-weight: bold;">Top công ty nổi bật</p>

        <div class="top-job1">
            @foreach($company_outstanding as $company)
                <div>
                    <form action="{{ Route('profile.user',['id' => $company->user_id]) }}" method="get">
                        <input type="hidden">
                        <button class="SL-job1 m-3" type="submit"
                                style="background-color:white;border-radius: 10px;border: none;">
                            <img class="img-job1" src="{{ url('image_avatar') }}/{{ $company->user->img_avatar }}"
                                 alt="">
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

    </section>

    @include('layout.page-js')
    <script>

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
                        if (res.data != '') {
                            var pro = res.data;
                            pro.forEach((function (item) {
                                message = '<h5 class="media-heading">' + res.message + '</h5>';
                                html += '   <img src="{{ url('image_avatar/')}}/' + item.image + ' " class="media-object" style="width:30px">';
                                html += '<div class="media-body">';
                                html += '   <h4 class="media-heading"> <a href="{{env('APP_DOMAIN')}}/post/post-detail/' + item.id + ' ">' + item.title + '</a></h4>';
                                // html += '       <p>' + item.Catelogies + '</p>';
                                html += '</div>';

                            }))
                            $('.search-ajax-result').html([message, html])
                        } else {
                            html += '<h4 class="media-heading"> Không tìm thấy</h4>';
                            $('.search-ajax-result').html(html)
                        }
                    }
                });
            } else {
                $('.search-ajax-result').html('');
            }
        });
    </script>
@endsection
