@extends('admin.dashboard.layout')
@section('content')
    <link href="{{ url('profile/demo/demo.css')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/paper-dashboard.css?v=2.0.1')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/bootstrap.min.css')  }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <div class="content">
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
                        <h4 class="card-title">Thông tin người dùng</h4>
                    </div>
                    <div class="card-body">
                        <div class="@if($users->isNotEmpty() && count($users) > 4) Scroll @endif">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>Tên hiển thị</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td class="text-content1">
                                            <button class="btn btn-outline-success" type="submit"
                                                    style="margin-right: 10px"
                                                    onclick="window.location='{{ Route('dashboard.profile.user',['id' => $user->id]) }}'">
                                                Chi tiết
                                            </button>
                                            <form action="{{ Route('admin.delete.user') }}" method="POST"
                                                  id="btn-delete-admin">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
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
    });
</script>
