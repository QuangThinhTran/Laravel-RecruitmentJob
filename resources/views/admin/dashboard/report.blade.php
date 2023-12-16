@extends('admin.dashboard.layout')
@section('content')
    @include('sweetalert::alert')
    <link href="{{ url('profile/demo/demo.css')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/paper-dashboard.css?v=2.0.1')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/bootstrap.min.css')  }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- End Navbar -->
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-single-copy-04 text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Báo cáo bài viết</p>
                                    <p class="card-title">
                                    <p>{{ $count_report_post }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i>
                            Hiện tại
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-circle-10 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category" style="font-size:15px">Báo cáo người dùng</p>
                                    <p class="card-title">
                                    <p>{{ $count_report_user }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i>
                            Hiện tại
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-email-85 text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Đã phản hồi</p>
                                    <p class="card-title">
                                    <p>{{ $count_report_reply }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar-o"></i>
                            Hiện tại
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-chat-33 text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Chưa phản hồi</p>
                                    <p class="card-title">
                                    <p>{{ $count_report_not_reply }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i>
                            Hiện tại
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách báo cáo bài viết chưa phản hồi</h4>
                    </div>
                    <div class="card-body">
                        <div
                            class="@if($report_post_not_reply->isNotEmpty() && count($report_post_not_reply) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th style="width:145px">Người gửi</th>
                                <th style="width: 50%">Nội dung</th>
                                <th >Ảnh</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody id="report_reply">
                                @foreach($report_post_not_reply as $post_not_reply)
                                    <tr>
                                        <td>{{ $post_not_reply->from_user->name }}</td>
                                        <td style="width:50%">{{ $post_not_reply->content }}</td>
                                        <td>
                                            @foreach($images as $img)
                                                @if($img->ticket_id == $post_not_reply->id)
                                                    <button class="btn btn-outline-success" type="submit"
                                                            value="{{ $img->ticket_id }}"
                                                            data-toggle="modal" data-target="#modalReportImage"
                                                            id="btn-post-images">
                                                        <img src="{{ url('Images')}}/{{ $img->image }}"
                                                             width="50px" height="50px">
                                                    </button>
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        {{--<td>{{ $post_not_reply->created_at->format('d-m-Y') }}</td>--}}
                                        <td>
                                            <button class="btn btn-outline-success" type="submit"
                                                    data-toggle="modal" data-target="#modalReport"
                                                    id="btn-reply" value="{{ $post_not_reply->id }}">Phản hồi
                                            </button>

                                            <button class="btn btn-outline-info" type="submit"
                                                    onclick="window.location='{{ Route('post.detail', $post_not_reply->post_id) }}'">
                                                Chi tiết
                                            </button>
                                            <button class="btn btn-outline-danger" type="submit"
                                                    onclick="window.location='{{ Route('report.delete',['id' => $post_not_reply->id]) }}'">
                                                Xoá
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách báo cáo người dùng chưa phản hồi</h4>
                    </div>
                    <div class="card-body">
                        <div
                            class="@if($report_user_not_reply->isNotEmpty() && count($report_user_not_reply) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th style="width: 145px">Người gửi</th>
                                <th>Người vi phạm</th>
                                <th style="width: 50%">Nội dung</th>
                                <th style="width:100px">Ảnh</th>
                                <th class="text-center" style="width:190px">Chức năng</th>
                                </thead>
                                <tbody id="report_user_reply">
                                @foreach($report_user_not_reply as $post_user_reply)
                                    <tr>
                                        <td>{{ $post_user_reply->from_user->name }}</td>
                                        <td><a href="{{ Route('profile.user', $post_user_reply->to_user_id) }}">{{ $post_user_reply->to_user->name }}</a></td>
                                        <td style="width:50%">{{ $post_user_reply->content }}</td>
                                        <td>
                                            @foreach($images as $img)
                                                @if($img->ticket_id == $post_user_reply->id)
                                                    <button class="btn btn-outline-success" type="submit"
                                                            value="{{ $img->ticket_id }}"
                                                            data-toggle="modal" data-target="#modalReportImage"
                                                            id="btn-post-images">
                                                        <img src="{{ url('Images')}}/{{ $img->image }}"
                                                             width="50px" height="50px">
                                                    </button>
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-success" type="submit"
                                                    data-toggle="modal" data-target="#modalReportUser"
                                                    id="btn-user-reply" value="{{ $post_user_reply->id }}">Phản hồi
                                            </button>
                                            <button class="btn btn-outline-danger" type="submit"
                                                    onclick="window.location='{{ Route('report.delete',['id' => $post_user_reply->id]) }}'">
                                                Xoá
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách báo cáo đánh giá chưa phản hồi</h4>
                    </div>
                    <div class="card-body">
                        <div
                            class="@if($report_ticket_not_reply->isNotEmpty() && count($report_ticket_not_reply) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th style="width:145px">Người gửi</th>
                                <th style="width: 50%">Nội dung</th>
                                <th>Ảnh</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody id="report_ticket_reply">
                                @foreach($report_ticket_not_reply as $ticket_not_reply)
                                    <tr>
                                        <td>{{ $ticket_not_reply->from_user->name }}</td>
                                        <td style="width:50%">{{ $ticket_not_reply->content }}</td>
                                        <td>
                                            @foreach($images as $img)
                                                @if($img->ticket_id == $ticket_not_reply->id)
                                                    <button class="btn btn-outline-success" type="submit"
                                                            value="{{ $img->ticket_id }}"
                                                            data-toggle="modal" data-target="#modalReportImage"
                                                            id="btn-ticket-images">
                                                        <img src="{{ url('Images')}}/{{ $img->image }}"
                                                             width="50px" height="50px">
                                                    </button>
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-success" type="submit"
                                                    data-toggle="modal" data-target="#modalReportReview"
                                                    id="btn-ticket-reply" value="{{ $ticket_not_reply->id }}">Phản hồi
                                            </button>
                                            <button class="btn btn-outline-info" type="submit"
                                                    data-toggle="modal" data-target="#modalDetailReview"
                                                    id="btn-ticket-detail" value="{{ $ticket_not_reply->id }}">Chi tiết
                                            </button>
                                            <button class="btn btn-outline-danger" type="submit"
                                                    onclick="window.location='{{ Route('report.delete',['id' => $ticket_not_reply->id]) }}'">
                                                Xoá
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal.report.slides_show')
    @include('modal.report.report')
    @include('modal.report.report_user')
    @include('modal.report.report_review')
    @include('modal.report.detail_review')
    @include('modal.report.detail-report')

    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách báo cáo bài viết đã phản hồi </h4>
                    </div>
                    <div class="card-body">
                        <div
                            class="@if($report_post_reply->isNotEmpty() && count($report_post_reply) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th style="width:145px">Người gửi</th>
                                <th style="width:50%">Nội dung</th>
                                <th>Ảnh</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody id="report_replied">
                                @foreach($report_post_replied as $post_reply)
                                    <tr>
                                        <td>{{ $post_reply->from_user->name }}</td>
                                        <td>{{ $post_reply->content }}</td>
                                        <td>
                                            @foreach($images as $img)
                                                @if($img->ticket_id == $post_reply->id)
                                                    <button class="btn btn-outline-success" type="submit"
                                                            value="{{ $img->ticket_id }}"
                                                            data-toggle="modal" data-target="#modalReportImage"
                                                            id="btn-post-images">
                                                        <img src="{{ url('Images')}}/{{ $img->image }}"
                                                             width="50px" height="50px">
                                                    </button>
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="d-flex">
                                            <button class="btn btn-outline-success " type="submit" 
                                                    data-toggle="modal"
                                                    data-target="#modalDetailReport"
                                                    id="btn-replied" value="{{ $post_reply->id }}">Nội dung
                                            </button>
                                            <button class="btn btn-outline-info" type="submit"
                                                    onclick="window.location='{{ Route('post.detail', $post_reply->post_id) }}'">
                                                Chi tiết
                                            </button>
                                            <button class="btn btn-outline-danger" type="submit" 
                                                    onclick="window.location='{{ Route('report.delete',['id' => $post_reply->id, 'role_id' => Auth::user()->role_id]) }}'">
                                                Xoá
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách báo cáo người dùng đã phản hồi </h4>
                    </div>
                    <div class="card-body">
                        <div
                            class="@if($report_user_replied->isNotEmpty() && count($report_user_replied) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th style="width:12%">Người gửi</th>
                                <th style="width:12%">Người vi phạm</th>
                                <th style="width:40%">Nội dung</th>
                                <th>Ảnh</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody id="report_user_replied">
                                @foreach($report_user_replied as $user_replied)
                                    <tr>
                                        <td>{{ $user_replied->from_user->name }}</td>
                                        <td><a href="{{ Route('profile.user', $post_user_reply->to_user_id) }}">{{ $user_replied->to_user->name }}</a></td>
                                        <td>{{ $user_replied->content }}</td>
                                        <td>
                                            @foreach($images as $img)
                                                @if($img->ticket_id == $user_replied->id)
                                                    <button class="btn btn-outline-success" type="submit"
                                                            value="{{ $img->ticket_id }}"
                                                            data-toggle="modal" data-target="#modalReportImage"
                                                            id="btn-user-images">
                                                        <img src="{{ url('Images')}}/{{ $img->image }}"
                                                             width="50px" height="50px">
                                                    </button>
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="d-flex justify-content-center" >
                                            <button class="btn btn-outline-success mt-3 mr-1 " type="submit" 
                                                    data-toggle="modal"
                                                    data-target="#modalDetailReportUser"
                                                    id="btn-user-replied" value="{{ $user_replied->id }}">Nội dung
                                            </button>
                                            <button class="btn btn-outline-danger mt-3  " type="submit" 
                                                    onclick="window.location='{{ Route('report.delete',['id' => $user_replied->id, 'role_id' => Auth::user()->role_id]) }}'">
                                                Xoá
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách báo cáo đánh giá đã phản hồi </h4>
                    </div>
                    <div class="card-body">
                        <div
                            class="@if($report_ticket_replied->isNotEmpty() && count($report_ticket_replied) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th style="width:145px">Người gửi</th>
                                <th style="width:50%">Nội dung</th>
                                <th>Ảnh</th>
                                <th>Ngày đăng</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody id="report_ticket_replied">
                                @foreach($report_ticket_replied as $ticket_replied)
                                    <tr>
                                        <td>{{ $ticket_replied->from_user->name }}</td>
                                        <td>{{ $ticket_replied->content }}</td>
                                        <td>
                                            @foreach($images as $img)
                                                @if($img->ticket_id == $ticket_replied->id)
                                                    <button class="btn btn-outline-success" type="submit"
                                                            value="{{ $img->ticket_id }}"
                                                            data-toggle="modal" data-target="#modalReportImage"
                                                            id="btn-user-images">
                                                        <img src="{{ url('Images')}}/{{ $img->image }}"
                                                             width="50px" height="50px">
                                                    </button>
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $ticket_replied->created_at->format('d-m-Y') }}</td>
                                        <td class="d-flex">
                                            <button class="btn btn-outline-success" type="submit" style="margin: 5px"
                                                    data-toggle="modal"
                                                    data-target="#modalDetailReportTicket"
                                                    id="btn-ticket-replied" value="{{ $ticket_replied->id }}">Nội dung
                                            </button>
                                            <button class="btn btn-outline-danger" type="submit" style="margin: 5px"
                                                    onclick="window.location='{{ Route('report.delete',['id' => $ticket_replied->id, 'role_id' => Auth::user()->role_id]) }}'">
                                                Xoá
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .Scroll {
            height: 580px;
            overflow-y: scroll;
        }
    </style>
    @include('modal.contact.detail-reply')
    @include('modal.report.detail-report-user')
    @include('modal.report.detail-report-review')
@endsection
<script src="{{ url('profile/js/core/jquery.min.js') }}"></script>
<script src="{{ url('profile/js/core/popper.min.js') }}"></script>
<script src="{{ url('profile/js/core/bootstrap.min.js') }}"></script>
<script src="{{ url('profile/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ url('profile/js/plugins/chartjs.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ url('profile/js/plugins/bootstrap-notify.js') }}"></script>


<script src="{{ url('profile/demo/demo.js')  }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {

        $('#report_reply').on('click', '#btn-reply', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.detail') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    console.log(res)
                    _li += '<input type="hidden" name="ticket_id" value="' + res.data.id + '">';
                    _li += '<input type="hidden" name="post_id" value="' + res.data.post_id + '">';
                    _li += '<input type="hidden" name="to_user_id" value="' + res.data.from_user_id + '">';
                    $('#replied_report').html(_li)
                }
            })
        })

        $('#report_user_reply').on('click', '#btn-user-reply', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.detail') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    console.log(res.data, 123)
                    _li += '<input type="hidden" name="ticket_id" value="' + res.data.id + '">';
                    _li += '<input type="hidden" name="review_id" value="' + res.data.ticket_id + '">';
                    _li += '<input type="hidden" name="to_user_id" value="' + res.data.from_user_id + '">';
                    $('#replied_user_report').html(_li)
                }
            })
        })

        $('#report_ticket_reply').on('click', '#btn-ticket-reply', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.detail') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    console.log(res.data, 123)
                    _li += '<input type="hidden" name="ticket_id" value="' + res.data.id + '">';
                    _li += '<input type="hidden" name="review_id" value="' + res.data.ticket_id + '">';
                    _li += '<input type="hidden" name="to_user_id" value="' + res.data.from_user_id + '">';
                    $('#replied_ticket_report').html(_li)
                }
            })
        })

        $('#report_ticket_reply').on('click', '#btn-ticket-detail', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.detail.review') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    var data = res.data
                    console.log(res.data)
                    _li += '<div class="row mt-3">';
                    _li += '    <div class="col-md-6">';
                    _li += '        <div class="form-group">';
                    _li += '            <label style="font-size: 17px;font-weight: bold">Người viết :</label>';
                    _li += '            <a href="{{ env('APP_DOMAIN') }}/profile/'+ data.from_user_id +'">' + data.from_user.name + '</a>';
                    _li += '        </div>';
                    _li += '    </div>';
                    _li += '</div>';
                    _li += '<div class="row mt-3">';
                    _li += '    <div class="col-md-6">';
                    _li += '        <div class="form-group">';
                    _li += '            <label style="font-size: 17px;font-weight: bold">Nội dung :</label><br>';
                    _li += '            <label>' + data.content + '</label>';
                    _li += '        </div>';
                    _li += '    </div>';
                    _li += '</div>';
                    $('#detail-report-review').html(_li)
                }
            })
        })

        $('#report_replied').on('click', '#btn-replied', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.replied') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    console.log(res)
                    _li += '<label for="recipient-name" class="col-form-label" style="font-weight: bold;">Người gửi : ' + res.data.from_user.username + ' </label><br>';
                    _li += '<label for="recipient-name" class="col-form-label" style="font-weight: bold;">Nội dung : </label><br>'
                    _li += '<label>' + res.data.content + '</label>';
                    $('#detail-replied').html(_li)
                }
            })
        })

        $('#report_user_replied').on('click', '#btn-user-replied', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.replied') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    console.log(res.result)
                    _li += '<label for="recipient-name" class="col-form-label" style="font-weight: bold;">Người gửi : ' + res.result.from_user.username + ' </label><br>';
                    _li += '<label for="recipient-name" class="col-form-label" style="font-weight: bold;">Nội dung : </label><br>'
                    _li += '<label>' + res.result.content + '</label>';
                    $('#detail-replied-user').html(_li)
                }
            })
        })

        $('#report_ticket_replied').on('click', '#btn-ticket-replied', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.replied') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    console.log(res.value)
                    _li += '<label for="recipient-name" class="col-form-label" style="font-weight: bold;">Người gửi : ' + res.value.from_user.username + ' </label><br>';
                    _li += '<label for="recipient-name" class="col-form-label" style="font-weight: bold;">Nội dung : </label><br>'
                    _li += '<label>' + res.value.content + '</label>';
                    $('#detail-replied-ticket').html(_li)
                }
            })
        })

        $('#report_reply').on('click', '#btn-post-images', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.image') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    var data = res.images;
                    var key = 0;
                    data.forEach(function (item) {
                        if (key == 0) {
                            _li += '<div class="carousel-item active">';
                            _li += '<img src="{{ url('Images')}}/' + item.image + '" class="d-block w-100" alt="...">';
                            _li += '</div>'
                        } else {
                            _li += '<div class="carousel-item">';
                            _li += '<img src="{{ url('Images')}}/' + item.image + '" class="d-block w-100" alt="...">';
                            _li += '</div>'
                        }
                        key += 1;
                        console.log(key)
                    })
                    $('#images').html(_li)
                }
            })
        })
        $('#report_replied').on('click', '#btn-post-images', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.image') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    var data = res.images;
                    var key = 0;
                    data.forEach(function (item) {
                        if (key == 0) {
                            _li += '<div class="carousel-item active">';
                            _li += '<img src="{{ url('Images')}}/' + item.image + '" class="d-block w-100" alt="...">';
                            _li += '</div>'
                        } else {
                            _li += '<div class="carousel-item">';
                            _li += '<img src="{{ url('Images')}}/' + item.image + '" class="d-block w-100" alt="...">';
                            _li += '</div>'
                        }
                        key += 1;
                        console.log(key)
                    })
                    $('#images').html(_li)
                }
            })
        })
        $('#report_user_reply').on('click', '#btn-user-images', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.image') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    var data = res.images;
                    var key = 0;
                    data.forEach(function (item) {
                        if (key == 0) {
                            _li += '<div class="carousel-item active">';
                            _li += '<img src="{{ url('Images')}}/' + item.image + '" class="d-block w-100" alt="...">';
                            _li += '</div>'
                        } else {
                            _li += '<div class="carousel-item">';
                            _li += '<img src="{{ url('Images')}}/' + item.image + '" class="d-block w-100" alt="...">';
                            _li += '</div>'
                        }
                        key += 1;
                        console.log(key)
                    })
                    $('#images').html(_li)
                }
            })
        })
        $('#report_user_replied').on('click', '#btn-user-images', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.image') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    var data = res.images;
                    var key = 0;
                    data.forEach(function (item) {
                        if (key == 0) {
                            _li += '<div class="carousel-item active">';
                            _li += '<img src="{{ url('Images')}}/' + item.image + '" class="d-block w-100" alt="...">';
                            _li += '</div>'
                        } else {
                            _li += '<div class="carousel-item">';
                            _li += '<img src="{{ url('Images')}}/' + item.image + '" class="d-block w-100" alt="...">';
                            _li += '</div>'
                        }
                        key += 1;
                        console.log(key)
                    })
                    $('#images').html(_li)
                }
            })
        })
        $('#report_ticket_reply').on('click', '#btn-ticket-images', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('report.image') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    var data = res.images;
                    var key = 0;
                    data.forEach(function (item) {
                        if (key == 0) {
                            _li += '<div class="carousel-item active">';
                            _li += '<img src="{{ url('Images')}}/' + item.image + '" class="d-block w-100" alt="...">';
                            _li += '</div>'
                        } else {
                            _li += '<div class="carousel-item">';
                            _li += '<img src="{{ url('Images')}}/' + item.image + '" class="d-block w-100" alt="...">';
                            _li += '</div>'
                        }
                        key += 1;
                        console.log(key)
                    })
                    $('#images').html(_li)
                }
            })
        })
    });
</script>
