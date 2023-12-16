@extends('layout.layout')
@section('index')
    @include('layout.searchAjax')
    </header>

<body>
<div class="site-section">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-12 pt-5">
                <ul class="job-listings mb-2">
                    @foreach($posts as $post)
                        <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                            <a href="{{ Route('post.detail', $post->id) }}" data-value=""></a>
                            <div class="job-listing-logo p-2">
                                <img src="{{ url('image_avatar/')}}/{{ $post->user->img_avatar }}"
                                     alt="Free Website Template by Free-Template.co" class="img-fluid" >
                            </div>
                            <div
                                class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                                <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                                    <strong>{{ $post->title }}</strong>
                                </div>
                                <div class="job-listing-location custom-width w-25 mb-3 mb-sm-0">
                                    <span class="icon-room"></span> {{ $post->workplace }}
                                </div>
                                <div class="job-listing-meta custom-width w-25 mt-2">
                                    <div style="display: flex;justify-content: center">
                                        <span class="badge badge-success">{{ $post->major }}</span>
                                    </div>

                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @if($posts->isNotEmpty())
                    {{ $posts->links('vendor.pagination.bootstrap-4')}}
                @endif
            </div>
        </div>
    </div>
</div>

<section class="site-section py-4" style="background-color:white;">
    <p style="color: black;font-size: 30px;font-weight: bold;text-align: center;">Top ngành nghề nổi bật</p>
    <div class="top-job">
        <div>
            <form action="{{ Route('post.major') }}" method="get">
                <input name="major" type="hidden" value="IT/ Công nghệ phần mềm">
                <button class="SL-job1" type="submit"
                        style="background-color:#f3f5f7;margin: 10px;border-radius: 10px;border: none;">
                    <img class="img-job" src="board-master/images/it-phan-mem.jpg" alt="">
                    <p>IT/ Công nghệ phần mềm</p>
                    <p>{{ $count_major_IT }} việc làm</p>
                </button>
            </form>
        </div>

        <div>
            <form action="{{ Route('post.major') }}" method="get">
                <input name="major" type="hidden" value="Kế toán">
                <button class="SL-job1" type="submit"
                        style="background-color:#f3f5f7;margin: 10px;border-radius: 10px;border: none;">
                    <img class="img-job" src="board-master/images/ke-toan-kiem-toan.jpg" alt="">
                    <p>Kế toán</p>
                    <p>{{ $count_major_accountant }} việc làm</p>
                </button>
            </form>
        </div>
        <div>
            <form action="{{ Route('post.major') }}" method="get">
                <input name="major" type="hidden" value="Marketing">
                <button class="SL-job1" type="submit"
                        style="background-color:#f3f5f7;margin: 10px;border-radius: 10px;border: none;">
                    <img class="img-job" src="board-master/images/marketing-truyen-thong-quang-cao.jpg" alt="">
                    <p>Marketing</p>
                    <p>{{ $count_major_marketing }} việc làm</p>
                </button>
            </form>
        </div>
        <div>
            <form action="{{ Route('post.major') }}" method="get">
                <input name="major" type="hidden" value="Chế tạo máy">
                <button class="SL-job1" type="submit"
                        style="background-color:#f3f5f7;margin: 10px;border-radius: 10px;border: none;">
                    <img class="img-job" src="board-master/images/co-khi.png" alt="">
                    <p>Chế tạo máy</p>
                    <p>{{ $count_major_manufacturing }} việc làm</p>
                </button>
            </form>
        </div>
        <div>
            <form action="{{ Route('post.major') }}" method="get">
                <input name="major" type="hidden" value="Điện/ Điện tử">
                <button class="SL-job1" type="submit"
                        style="background-color:#f3f5f7;margin: 10px;border-radius: 10px;border: none;">
                    <img class="img-job" src="board-master/images/dien-dien-tu-1.jpg" alt="">
                    <p>Điện/ Điện tử</p>
                    <p>{{ $count_major_electronics }} việc làm</p>
                </button>
            </form>
        </div>
        <div>
            <form action="{{ Route('post.major') }}" method="get">
                <input name="major" type="hidden" value="Báo chí/ Truyền hình">
                <button class="SL-job1" type="submit"
                        style="background-color:#f3f5f7;margin: 10px;border-radius: 10px;border: none;">
                    <img class="img-job" src="board-master/images/news.jpg" alt="">
                    <p>Báo chí/ Truyền hình</p>
                    <p>{{ $count_major_newspapers }} việc làm</p>
                </button>
            </form>
        </div>
        <div>
            <form action="{{ Route('post.major') }}" method="get">
                <input name="major" type="hidden" value="Bất động sản">
                <button class="SL-job1" type="submit"
                        style="background-color:#f3f5f7;margin: 10px;border-radius: 10px;border: none;">
                    <img class="img-job" src="board-master/images/bat-dong-san.png" alt="">
                    <p>Bất động sản</p>
                    <p>{{ $count_major_real_estate }} việc làm</p>
                </button>
            </form>
        </div>
        <div>
            <form action="{{ Route('post.major') }}" method="get">
                <input name="major" type="hidden" value="Công nghệ Ô tô">
                <button class="SL-job1" type="submit"
                        style="background-color:#f3f5f7;margin: 10px;border-radius: 10px;border: none;">
                    <img class="img-job" src="board-master/images/oto.jpg" alt="">
                    <p>Công nghệ Ô tô</p>
                    <p>{{ $count_major_car_technology }} việc làm</p>
                </button>
            </form>
        </div>
    </div>
</section>

<section class="site-section py-4" style="background-color:white;">
    <p style="color: black;font-size: 30px;font-weight: bold;text-align: center;">Top công ty nổi bật</p>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>--}}
<script>
    $(document).ready(function () {
        // $('.multiple-items').slick({
        //     slidesToShow: 1,
        //     slidesToScroll: 1,
        //     dots: true,
        //     infinite: true,
        //     cssEase: 'linear'
        // });
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
    });
</script>
@endsection
