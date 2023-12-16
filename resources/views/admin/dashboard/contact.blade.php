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
                                    <i class="nc-icon nc-email-85 text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Tổng số liên hệ</p>
                                    <p class="card-title" id="count_contact">
                                    <p>{{ $count_contact }}
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
                                    <i class="nc-icon nc-email-85 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Đã phản hồi</p>
                                    <p class="card-title" id="count_contact_reply">
                                    <p>{{ $count_contact_reply }}
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
                                    <p class="card-title" id="count_contact_not_reply">
                                    <p>{{ $count_contact_not_reply }}
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
                        <h4 class="card-title"> Danh sách liên hệ chưa phản hồi</h4>
                    </div>
                    <div class="card-body">
                        <div
                            class="@if($contact_not_reply->isNotEmpty() && count($contact_not_reply) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>Người gửi</th>
                                <th width="50%">Nội dung</th>
                                <th>Ngày đăng</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody id="contact_reply">
                                @foreach($contact_not_reply as $key => $not_reply)
                                    <tr>
                                        @if($not_reply->username == null)
                                            <td>{{ $not_reply->from_user->name }}</td>
                                        @else
                                            <td>{{ $not_reply->username }}</td>
                                        @endif
                                        <td>{{ $not_reply->content }}</td>
                                        <td>{{ $not_reply->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <button class="btn btn-outline-success" type="submit" style="margin: 5px"
                                                    data-value="123" data-toggle="modal"
                                                    data-target="#modalRepliedContact"
                                                    id="btn-reply" value="{{ $not_reply->id }}">Phản hồi
                                            </button>
                                            <button class="btn btn-outline-danger" type="submit" style="margin: 5px"
                                                    onclick="window.location='{{ Route('contact.delete',['id' => $not_reply->id]) }}'">
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
    @include('modal.contact.detail-reply')
    @include('modal.contact.replied')
    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách bài liên hệ đã phản hồi </h4>
                    </div>
                    <div class="card-body">
                        <div class="@if($contact_reply->isNotEmpty() && count($contact_reply) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>Người gửi</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody id="contact_replied">
                                @foreach($contact_reply as $reply)
                                    <tr>
                                        @if($reply->username == null)
                                            <td>{{ $reply->from_user->name }}</td>
                                        @else
                                            <td>{{ $reply->username }}</td>
                                        @endif
                                        <td>{{ $reply->content }}</td>
                                        <td>{{ $reply->created_at->format('d-m-Y') }}</td>
                                        <td class="d-flex">
                                            <button class="btn btn-outline-success" type="submit" style="margin: 5px"
                                                    data-toggle="modal"
                                                    data-target="#modalDetailRepliedContact"
                                                    id="btn-replied" value="{{ $reply->id }}">Nội dung
                                            </button>
                                            <button class="btn btn-outline-danger" type="submit" style="margin: 5px"
                                                    onclick="window.location='{{ Route('contact.delete',['id' => $reply->id]) }}'">
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
    @include('modal.contact.detail-reply')
    <style>
        .Scroll {
            height: 580px;
            overflow-y: scroll;
        }
    </style>
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

        $('#contact_replied').on('click', '#btn-replied', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('contact.replied') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    console.log(value)
                    _li += '<label for="recipient-name" class="col-form-label" style="font-weight: bold;">Người gửi : ' + res.data.from_user.username + ' </label><br>';
                    _li += '<label for="recipient-name" class="col-form-label" style="font-weight: bold;">Nội dung : </label><br>'
                    _li += '<label>' + res.data.content + '</label>';
                    $('#detail-replied').html(_li)
                }
            })
        })

        $('#contact_reply').on('click', '#btn-reply', function () {
            var _li = '';
            var value = {'id': $(this).val()}
            $.ajax({
                url: "{{ Route('contact.detail') }}",
                type: "GET",
                data: value,
                success: function (res) {
                    console.log(res)
                    _li += '<input type="hidden" name="ticket_id" value="' + res.data.id + '">';
                    _li += '<input type="hidden" name="to_user_id" value="' + res.data.from_user_id + '">';
                    _li += '<input type="hidden" name="email" value="' + res.data.email + '">';
                    $('#replied_contact').html(_li)
                }
            })
        })
    });
</script>
