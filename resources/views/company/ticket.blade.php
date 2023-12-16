@extends('company.layout')
@section('content')
    @include('sweetalert::alert')
    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Danh sách phản hồi </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>Tên người gửi</th>
                                <th>Nội dung</th>
                                <th class="text-center">Chức năng</th>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>Hệ thống Finding Job</td>
                                        <td>{{ $ticket->content }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-danger" type="submit" style="color: white"
                                                    onclick="window.location='{{ Route('company.ticket.delete',['id' => $ticket->id]) }}'">Xoá</button>
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
