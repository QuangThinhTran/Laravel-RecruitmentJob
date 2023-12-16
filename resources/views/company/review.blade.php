@extends('company.layout')
@section('content')
    @include('sweetalert::alert')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{--    <div class="col-6">--}}
    {{--        <a class="btn btn-block btn-light btn-md " role="button" data-toggle="dropdown"--}}
    {{--           aria-expanded="false"><span--}}
    {{--                class="icon-th-large mr-2 text-danger"></span>Chức năng</a>--}}
    {{--        <div class="dropdown-menu">--}}
    {{--            <button type="submit" class="dropdown-item" data-toggle="modal"--}}
    {{--                    data-target="#modalReportPost">Báo cáo bài viết--}}
    {{--            </button>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div id="report_user" style="display:flex;flex-wrap:wrap;">
        @foreach($reviews as $review)
            <div class="app-card app-card-notification shadow-sm m-2" style="width:30%">
                <div class="app-card-header" style="display:flex;">
                    <div class="col-12 col-lg-auto text-center text-lg-start mt-2">
                        <img class="profile-image"
                             src="{{ url('image_avatar') }}/{{ $review->from_user->img_avatar }}"
                             alt="">
                    </div>
                    <div class="mt-2" style="display:flex;justify-content:space-between;width:100%">
                        <div class="col-12 col-lg-auto text-lg-start" style="padding: 0">
                            <div class="notification-type mb-2">
                                <label
                                    style="font-size: 19px;font-weight: bold">{{ $review->from_user->username }}</label>
                            </div>
                            <label style="font-size: 15px">{{ $review->created_at->format('d-m-Y') }}</label>
                        </div>
                        <div class="col-3">
                            <a class="btn btn-light" role="button" data-toggle="dropdown"
                               aria-expanded="false"><i class="fas fa-bars"></i></a>
                            <div class="dropdown-menu">
                                <button type="submit" class="dropdown-item" data-toggle="modal"
                                        value="{{ $review->from_user_id }},{{ $review->id }}"
                                        data-target="#modalCompanyReport" id="company_report_user">Báo cáo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-card-body p-4">
                    <div class="notification-content">{{ $review->content }}</div>
                </div>
            </div>

        @endforeach
    </div>
    @include('modal.report.company_report')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(() => {
            $('#report_user').on('click', '#company_report_user', function () {
                var data = $(this).val().split(',')
                var id = data[0]
                var ticket_id = data[1]
                var _li = '';
                console.log(ticket_id)
                _li += '<input type="hidden" name="to_user_id" value="' + id + '">';
                _li += '<input type="hidden" name="ticket_id" value="' + ticket_id + '">'
                $('#company-report').html(_li)
            })
        })
    </script>
@endsection
