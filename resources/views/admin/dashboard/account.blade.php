@extends('admin.dashboard.layout')
@section('content')
    <link href="{{ url('profile/demo/demo.css')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/paper-dashboard.css?v=2.0.1')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/bootstrap.min.css')  }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                                    <p class="card-category" style="font-size:15px">Tổng số người dùng</p>
                                    <p class="card-title">
                                    {{ $all_user }}
                                    <p>
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
                                    <i class="nc-icon nc-settings text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Quản trị viên</p>
                                    <p class="card-title"></p>
                                    {{ $count_user_admin }}
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
                                    <i class="nc-icon nc-badge text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Nhà tuyển dụng</p>
                                    <p class="card-title">
                                        {{ $count_user_company }}
                                    </p>
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
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-single-02 text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Ứng cử viên</p>
                                    <p class="card-title">
                                        {{ $count_user_candidate }}
                                    </p>
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
        </div>
    </div>

    <div class="content" style="margin-top: 5px">
    <form action="{{ Route('search.user') }}" method="post">
        @csrf
        <input type="text" style="width: 22%;padding: 5px;border-radius: 5px;" name="name" placeholder="Nhập tên hiển thị bạn muốn tìm">
        <input type="text" style="width: 22%;padding: 5px;border-radius: 5px;" name="email" placeholder="Nhập email bạn muốn tìm">
        <button type="submit" style="border-radius:5px;padding:5px" class="btn-outline-success">Tìm kiếm</button>
    </form>
</div>



    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Quản trị viên</h4>
                    </div>
                    <div class="card-body">
                        <div class="@if($user_admin->isNotEmpty() && count($user_admin) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>Tên hiển thị</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody>
                                @foreach($user_admin as $admin)
                                    <tr>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td class="text-content1">
                                            <button class="btn btn-outline-success" type="submit"
                                                    style="margin-right: 10px"
                                                    onclick="window.location='{{ Route('dashboard.profile.user',['id' => $admin->id]) }}'">
                                                Chi tiết
                                            </button>
                                            <form action="{{ Route('admin.delete.user') }}" method="POST"
                                                  id="btn-delete-admin">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $admin->id }}">
                                                <button class="btn btn-outline-danger" type="submit">
                                                    Xoá
                                                </button>
                                            </form>
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
                        <h4 class="card-title"> Nhà tuyển dụng </h4>
                    </div>
                    <div class="card-body">
                        <div class="@if($user_company->isNotEmpty() && count($user_company) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>Tên công ty</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody>
                                @foreach($user_company as $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->phone }}</td>
                                        <td class="text-content1">
                                            <button class="btn btn-outline-success" type="submit"
                                                    style="margin-right: 10px"
                                                    onclick="window.location='{{ Route('dashboard.profile.user',['id' => $company->id]) }}'">
                                                Chi tiết
                                            </button>
                                            <form action="{{ Route('admin.delete.user') }}" method="POST"
                                                  id="btn-delete-company">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $company->id }}">
                                                <button class="btn btn-outline-danger" type="submit">
                                                    Xoá
                                                </button>
                                            </form>
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
                        <h4 class="card-title"> Ứng cử viên </h4>
                    </div>
                    <div class="card-body">
                        <div class="@if($user_candidate->isNotEmpty() && count($user_candidate) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>Tên hiển thị</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody>
                                @foreach($user_candidate as $candidate)
                                    <tr>
                                        <td>{{ $candidate->name }}</td>
                                        <td>{{ $candidate->email }}</td>
                                        <td>{{ $candidate->phone }}</td>
                                        <td class="text-content1">
                                            <button class="btn btn-outline-success" type="submit"
                                                    style="margin-right: 10px"
                                                    onclick="window.location='{{ Route('dashboard.profile.user',['id' => $candidate->id]) }}'">
                                                Chi tiết
                                            </button>
                                            <form action="{{ Route('admin.delete.user') }}" method="POST"
                                                  id="btn-delete-candidate">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $candidate->id }}">
                                                <button class="btn btn-outline-danger" type="submit">
                                                    Xoá
                                                </button>
                                            </form>
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
                        <h4 class="card-title"> Những tài khoản bạn đã xoá </h4>
                    </div>
                    <div class="card-body">
                        <div class="@if($user_trashed->isNotEmpty() && count($user_trashed) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>Tên hiển thị</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody>
                                @foreach($user_trashed as $trashed)
                                    <tr>
                                        <td>{{ $trashed->name }}</td>
                                        <td>{{ $trashed->email }}</td>
                                        <td>{{ $trashed->phone }}</td>
                                        <td class="text-content1">
                                            <button class="btn btn-outline-success" type="submit"
                                                    style="margin-right: 10px"
                                                    onclick="window.location='{{ Route('dashboard.profile.user',['id' => $trashed->id]) }}'">
                                                Chi tiết
                                            </button>
                                            <form action="{{ Route('admin.restore.user') }}" method="POST"
                                                  id="btn-restore-user">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $trashed->id }}">
                                                <button class="btn btn-outline-dark" type="submit">
                                                    Khôi phục
                                                </button>
                                            </form>
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
        .text-content1 {
            display: flex;
            justify-content: center;
        }

        .text-content1 button {
            height: fit-content;
            margin-right: 10px;
        }

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
        $(document).on('click', '#btn-delete-admin', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data)
            Swal.fire({
                title: 'Bạn muốn xoá người dùng?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Không',
                confirmButtonText: 'Có',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ Route('admin.delete.user') }}',
                        type: 'POST',
                        data: data,
                        success: function () {
                            $('#btn-delete-admin').submit()
                            window.location.reload('{{ Route('dashboard.account') }}');
                            $.get('{{ Route('mail.delete.user') }}/?id=' + data)
                        }
                    })
                    Swal.fire(
                        'Đã xoá thành công!',
                    )
                }
            })
        });

        $(document).on('click', '#btn-delete-company', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data)
            Swal.fire({
                title: 'Bạn muốn xoá người dùng?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Không',
                confirmButtonText: 'Có',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ Route('admin.delete.user') }}',
                        type: 'POST',
                        data: data,
                        success: function () {
                            $('#btn-delete-company').submit()
                            window.location.reload('{{ Route('dashboard.account') }}');
                            $.get('{{ Route('mail.delete.user') }}/?id=' + data)
                        }
                    })
                    Swal.fire(
                        'Đã xoá thành công!',
                    )
                }
            })
        });

        $(document).on('click', '#btn-delete-candidate', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data)
            Swal.fire({
                title: 'Bạn muốn xoá người dùng?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Không',
                confirmButtonText: 'Có',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ Route('admin.delete.user') }}',
                        type: 'POST',
                        data: data,
                        success: function () {
                            $('#btn-delete-candidate').submit()
                            window.location.reload('{{ Route('dashboard.account') }}');
                            $.get('{{ Route('mail.delete.user') }}/?id=' + data)
                        }
                    })
                    Swal.fire(
                        'Đã xoá thành công!',
                    )
                }
            })
        });

        $(document).on('click', '#btn-restore-user', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data)
            Swal.fire({
                title: 'Bạn muốn khôi phục tài khoản?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Không',
                confirmButtonText: 'Có',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ Route('admin.restore.user') }}',
                        type: 'POST',
                        data: data,
                        success: function () {
                            $('#btn-restore-user').submit()
                            window.location.reload('{{ Route('dashboard.account') }}');
                            $.get('{{ Route('mail.restore.user') }}/?id=' + data)
                        }
                    })
                    Swal.fire(
                        'Khôi phục thành công!',
                    )
                }
            })
        });
    });
</script>
