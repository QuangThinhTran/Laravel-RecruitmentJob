@extends('admin.dashboard.layout')
@section('content')
    @include('sweetalert::alert')
    <link href="{{ url('profile/demo/demo.css')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/paper-dashboard.css?v=2.0.1')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/bootstrap.min.css')  }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-body ">
                        <div class="container1" id="imgBox" style="text-align:center">
                            <label for="file">
                                <img src="{{ url('image_avatar/') }}/{{ Auth::user()->img_avatar }}" width="200px"
                                     height="200px">
                            </label>
                        </div>
                        <div class="d-flex align-items-center text-center p-1 py-3">
                            <label style="font-weight: bold;font-size: 18px"> {{ $user->name }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Thông tin cá nhân</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: bold;font-size: 18px">Tên đăng nhập : </label>
                                    <label style="font-size: 18px">{{ $user->username }}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-weight: bold;font-size: 18px">Số điện thoại : </label>
                                    <label style="font-size: 18px">{{ $user->phone }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="font-weight: bold;font-size: 18px">Email : </label>
                                <label style="font-size: 18px">{{ $user->email }}</label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="font-weight: bold;font-size: 18px">Địa chỉ : </label>
                                <label style="font-size: 18px">{{ $user->address }}</label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="font-weight: bold;font-size: 18px">Chuyên ngành : </label>
                                <label style="font-size: 18px">{{ $user->major }}</label><br>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label style="font-weight: bold;font-size: 18px">Vị trí : </label>
                                <label style="font-size: 18px">{{ $user->position }}</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                @if($user->role_id == 2)
                    <div class="card card-user">
                        <div class="card-header">
                            <h5 class="card-title">Thông tin công ty</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label style="font-weight: bold;font-size: 18px">Số nhân viên : </label>
                                        <label style="font-size: 18px">{{ $company->staff }}</label><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label style="font-weight: bold;font-size: 18px">Trụ sở chính : </label>
                                    <label style="font-size: 18px">{{ $company->headquarters }}</label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label style="font-weight: bold;font-size: 18px">Mã số thuế : </label>
                                    <label style="font-size: 18px">{{ $company->taxcode }}</label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label style="font-weight: bold;font-size: 18px">Mô tả : </label>
                                    <label style="font-size: 18px">{{ $company->description }}</label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label style="font-weight: bold;font-size: 18px">Website : </label>
                                    <label style="font-size: 18px">{{ $company->website }}</label><br>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('layout.page-js')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
@endsection
