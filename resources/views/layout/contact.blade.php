@extends('layout.layout')
@section('content')
    </header>

<body>
    @include('sweetalert::alert')
    <div class="site-wrap">
        <!-- HOME -->
        <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');"
                 id="home-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1 class="text-white font-weight-bold">Liên hệ</h1>
                        <div class="custom-breadcrumbs">
                            <a href="{{ Route('home')}}">Trang chủ</a> <span class="mx-2 slash">/</span>
                            <span class="text-white"><strong>Liên hệ</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="site-section" id="next-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <form action="{{ Route('contact.create') }}" class="" method="post">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="text-black" for="fname">Họ và tên</label>
                                    <input type="text" id="fname" name="username" class="form-control">
                                    @error('username')
                                    <div style="color:red;">{{ $message }}</div><br>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">

                                <div class="col-md-12">
                                    <label class="text-black" for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control">
                                    @error('email')
                                    <div style="color:red;" >{{ $message }}</div><br>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="text-black" for="message">Nội dung</label>
                                    <textarea name="content" id="message" cols="30" rows="7" class="form-control"
                                              placeholder="Viết ghi chú hoặc câu hỏi của bạn ở đây..."></textarea>
                                    @error('content')
                                    <div style="color:red;" >{{ $message }}</div><br>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <input type="submit" value="Gửi liên hệ" class="btn btn-primary btn-md text-white">
                                </div>
                            </div>
                        </form>
                    </div>
                    {{--                    <div class="col-lg-5 ml-auto">--}}
                    {{--                        <div class="p-4 mb-3 bg-white">--}}
                    {{--                            <p class="mb-0 font-weight-bold">Address</p>--}}
                    {{--                            <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>--}}

                    {{--                            <p class="mb-0 font-weight-bold">Phone</p>--}}
                    {{--                            <p class="mb-4"><a href="#">+1 232 3235 324</a></p>--}}

                    {{--                            <p class="mb-0 font-weight-bold">Email Address</p>--}}
                    {{--                            <p class="mb-0"><a href="#">youremail@domain.com</a></p>--}}

                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </section>
        {{--        <section class="site-section bg-light">--}}
        {{--            <div class="container">--}}
        {{--                <div class="row mb-5">--}}
        {{--                    <div class="col-12 text-center" data-aos="fade">--}}
        {{--                        <h2 class="section-title mb-3">Happy Candidates Says</h2>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="row">--}}
        {{--                    <div class="col-lg-6">--}}
        {{--                        <div class="block__87154 bg-white rounded">--}}
        {{--                            <blockquote>--}}
        {{--                                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam cumque vero vitae enim--}}
        {{--                                    cupiditate--}}
        {{--                                    deserunt eligendi officia modi consectetur. Expedita tempora quos nobis earum hic ex--}}
        {{--                                    asperiores quisquam optio nostrum sit&rdquo;</p>--}}
        {{--                            </blockquote>--}}
        {{--                            <div class="block__91147 d-flex align-items-center">--}}
        {{--                                <figure class="mr-4"><img src="images/person_1.jpg" alt="Image" class="img-fluid">--}}
        {{--                                </figure>--}}
        {{--                                <div>--}}
        {{--                                    <h3>Elisabeth Smith</h3>--}}
        {{--                                    <span class="position">Creative Director</span>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}

        {{--                    <div class="col-lg-6">--}}
        {{--                        <div class="block__87154 bg-white rounded">--}}
        {{--                            <blockquote>--}}
        {{--                                <p>&ldquo;Ipsum harum assumenda in eum vel eveniet numquam, cumque vero vitae enim--}}
        {{--                                    cupiditate deserunt eligendi officia modi consectetur. Expedita tempora quos nobis--}}
        {{--                                    earum--}}
        {{--                                    hic ex asperiores quisquam optio nostrum sit&rdquo;</p>--}}
        {{--                            </blockquote>--}}
        {{--                            <div class="block__91147 d-flex align-items-center">--}}
        {{--                                <figure class="mr-4"><img src="images/person_2.jpg" alt="Image" class="img-fluid">--}}
        {{--                                </figure>--}}
        {{--                                <div>--}}
        {{--                                    <h3>Chris Peter</h3>--}}
        {{--                                    <span class="position">Web Designer</span>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}
    </div>
@endsection
