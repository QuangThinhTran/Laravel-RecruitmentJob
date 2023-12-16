@extends('admin.dashboard.layout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="content">
        <form action="{{ Route('backend.filter.datetime') }}" method="post">
            @csrf
            <div class="form-group mb-2">
                <div class="row ">
                    <div class="col-lg-3 col-sm-6">
                        <label for="startDate">Từ</label>
                        <input name="from" class="form-control" type="date" />
                        <!-- <span id="startDateSelected"></span> -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <label for="endDate">Đến</label>
                        <input name="to" class="form-control " type="date" />
                        <!-- <span id="endDateSelected"></span> -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <button class="search-1" type="submit">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="content" style="margin-top: 5px">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Lịch sử </h4>
                        </div>
                        <div class="card-body">
                            <div class="@if($history->isNotEmpty() && count($history) > 8) Scroll @endif">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>Thời gian</th>
                                    <th>Tên người dùng</th>
                                    <th>Hoạt động</th>
                                    <th class="text-center">Chức năng</th>
                                    </thead>
                                    <tbody id="history">
                                    @foreach($history as $data)
                                        <tr>
                                            <td>{{ $data->created_at->format('d-m-Y H:i') }}</td>
                                            <td>{{ $data->user->name }}</td>
                                                <?php
                                                $value = explode('*', $data->content);
                                                ?>
                                            <td>{{ $value[0] }}</td>
                                            <td class="text-center">
                                                @if(strpos($data->content, 'tuyển dụng'))
                                                    <button class="btn btn-outline-success" type="submit"
                                                            style="margin: 5px"
                                                            value="{{ $value[1] }}" data-toggle="modal"
                                                            data-target="#modalPost"
                                                            id="post">Chi tiết
                                                    </button>
                                                @elseif(strpos($data->content, 'liên hệ') || strpos($data->content, 'báo cáo'))
                                                    <button class="btn btn-outline-success" type="submit"
                                                            style="margin: 5px"
                                                            value="{{ $value[1] }}" data-toggle="modal"
                                                            data-target="#modalTicket"
                                                            id="ticket">Chi tiết
                                                    </button>
                                                @elseif(strpos($data->content, 'người dùng'))
                                                    <button class="btn btn-outline-success" type="submit"
                                                            style="margin: 5px"
                                                            value="{{ $value[1] }}" data-toggle="modal"
                                                            data-target="#modalUser"
                                                            id="user">Chi tiết
                                                    </button>
                                                @endif
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
    </div>
    @include('modal.history.post')
    @include('modal.history.user')
    @include('modal.history.ticket')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <style>
        .Scroll {
            height: 580px;
            overflow-y: scroll;
        }
    </style>
    <script>

        var button = $('#history')

        button.on('click', '#user', function () {
            var data = $(this).val()
            var _li = '';
            $.get('{{ Route('backend.user') }}/?id='+ data +'',function (res) {
                var value = res.user;
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Họ và tên :</label>';
                _li += '            <label>'+ value.name +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Số điện thoại :</label>';
                _li += '            <label>'+ value.phone +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Email :</label>';
                _li += '            <label>'+ value.email +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Địa chỉ :</label>';
                _li += '            <label>'+ value.address +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Chuyên ngành :</label>';
                _li += '            <label>'+ value.major +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Vị trí :</label>';
                _li += '            <label>'+ value.position +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-12">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Mô tả :</label>';
                _li += '            <label>'+ value.description +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                $('#user-information').html(_li)
            })
        })
        button.on('click', '#post', function () {
            var data = $(this).val()
            var _li = '';
            $.get('{{ Route('backend.post') }}/?id='+ data +'',function (res) {
                var value = res.post;
                console.log(value)
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-12">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Tiêu đề :</label>';
                _li += '            <label>'+ value.title +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-12">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Mô tả :</label>';
                _li += '            <label>'+ value.description +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-12">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Lợi ích :</label>';
                _li += '            <label>'+ value.benefit +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-12">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Yêu cầu :</label>';
                _li += '            <label>'+ value.requirements +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Chuyên ngành :</label>';
                _li += '            <label>'+ value.major +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Kinh nghiệm :</label>';
                _li += '            <label>'+ value.experience +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Vị trí :</label>';
                _li += '            <label>'+ value.position +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Loại hình :</label>';
                _li += '            <label>'+ value.working +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Địa chỉ :</label>';
                _li += '            <label>'+ value.workplace +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Số lượng :</label>';
                _li += '            <label>'+ value.quantity +'</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                $('#post-information').html(_li)
            })
        })
        button.on('click', '#ticket', function () {
            var data = $(this).val()
            var _li = '';
            console.log(data)
            $.get('{{ Route('backend.ticket') }}/?id=' + data + '', function (res) {
                var value = res.ticket;
                var data = res.reply_ticket
                console.log(data)
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Từ :</label>';
                _li += '            <label>' + value.from_user.name + '</label>';
                _li += '        </div>';
                _li += '    </div>';
                if (value.to_user != null) {
                    _li += '    <div class="col-md-6">';
                    _li += '        <div class="form-group">';
                    _li += '            <label style="font-size: 17px;font-weight: bold">Đến :</label>';
                    _li += '            <label>' + value.to_user.name + '</label>';
                    _li += '        </div>';
                    _li += '    </div>';
                }
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-6">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Loại :</label>';
                _li += '            <label>' + value.type.content + '</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                _li += '<div class="row mt-3">';
                _li += '    <div class="col-md-12">';
                _li += '        <div class="form-group">';
                _li += '            <label style="font-size: 17px;font-weight: bold">Nội dung :</label>';
                _li += '            <label>' + value.content + '</label>';
                _li += '        </div>';
                _li += '    </div>';
                _li += '</div>';
                if (data != null) {
                    _li += '<div class="row mt-3">';
                    _li += '    <div class="col-md-6">';
                    _li += '        <div class="form-group">';
                    _li += '            <label style="font-size: 17px;font-weight: bold">Tạo bởi :</label>';
                    _li += '            <label>' + data.from_user.name + '</label>';
                    _li += '        </div>';
                    _li += '    </div>';
                    _li += '</div>';
                    _li += '<div class="row mt-3">';
                    _li += '    <div class="col-md-12">';
                    _li += '        <div class="form-group">';
                    _li += '            <label style="font-size: 17px;font-weight: bold">Nội dung phản hồi:</label><br>';
                    _li += '            <label>' + data.content + '</label>';
                    _li += '        </div>';
                    _li += '    </div>';
                    _li += '</div>';
                }
                $('#ticket-information').html(_li)
            })
        })
    </script>
@endsection
