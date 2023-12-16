@extends('company.layout')
@section('content')
    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách ứng viên </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Chức năng</th>
                                </thead>
                                <tbody>
                                @foreach($applied as $user)
                                    <tr>
                                        <td>{{ $user->user->name }}</td>
                                        <td>{{ $user->user->email }}</td>
                                        <td>{{ $user->user->phone }}</td>
                                        <td>
                                            <button class="btn btn-warning" type="submit" style="color: white"
                                                    onclick="window.location='{{ Route('profile.user',['id' => $user->user_id]) }}'">Chi tiết</button>
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
@endsection
