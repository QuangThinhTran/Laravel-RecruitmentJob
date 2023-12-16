<!-- @extends('admin.dashboard.layout')
@section('content')
    @include('sweetalert::alert') -->
    <link href="{{ url('profile/demo/demo.css')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/paper-dashboard.css?v=2.0.1')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/bootstrap.min.css')  }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-body">
                        <form action="{{ Route('profile.update.basic') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container1" id="imgBox">
                                <label for="file">
                                    <img src="{{ url('image_avatar/') }}/{{ Auth::user()->img_avatar }}" width="200px"
                                         height="200px">
                                </label>
                                <input type="file" name="img_avatar" id="file" onchange="loadFile(event)">
                            </div>
                            <div class="d-flex align-items-center text-center p-1 py-3">
                                <input type="hidden" name="role_id" value="{{ Auth::user()->role_id }}">
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <input type="text" name="name" value="{{ $user->name }}" id=""
                                       style="border-radius:5px;margin-right:4px">
                                <button class="btn btn-sm btn-outline-success btn-round btn-icon" id="test">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Đổi mật khẩu</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ Route('password.update') }}" method="post">
                            @csrf
                            <div class="col-md-6" style="margin-left:25%">
                                <label>Nhập mật khẩu hiện tại</label>
                                <input type="password" class="inputpass" name="password_old" value="">
                                @error('password_old')
                                <div style="color:red;">{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                            <div class="col-md-6" style="margin-left:25%">
                                <label>Nhập mật khẩu mới</label>
                                <input type="password" class="inputpass" name="password" value="">
                                @error('password')
                                <div style="color:red;">{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                            <div class="col-md-6" style="margin-left:25%">
                                <label>Nhập lại mật khẩu mới</label>
                                <input type="password" class="inputpass" name="password_confirmation" value="">
                                @error('password_confirmation')
                                <div style="color:red;">{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="mt-2 text-center">
                                <button class="btn btn-warning profile-button"
                                        type="submit">Xác nhận
                                </button>
                                @if(session('Error'))
                                    <p style="color:red">{{session('Error')}}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Chỉnh sửa thông tin cá nhân</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ Route('profile.update') }}" method="post">
                            @csrf
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên đăng nhập</label><br>
                                        <input type="text" class="form-control" name="username"
                                               value="{{ $user->username }}">
                                    </div>
                                    @error('username')
                                    <div style="color:red;">{{ $message }}</div>
                                    <br>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                                    </div>
                                    @error('phone')
                                    <div style="color:red;">{{ $message }}</div>
                                    <br>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                                    @error('email')
                                    <div style="color:red;">{{ $message }}</div>
                                    <br>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                                    @error('address')
                                    <div style="color:red;">{{ $message }}</div>
                                    <br>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="job-region">Chuyên ngành</label><br>
                                    <select class="selectpicker border rounded" style=" padding: 10px;" id="job-region"
                                            data-style="btn-black" data-width="100%" data-live-search="true"
                                            title="Select Region" name="major">
                                        <option>IT/ Công nghệ phần mềm</option>
                                        <option>Kế toán</option>
                                        <option>Makerting</option>
                                        <option>Chế tạo máy</option>
                                        <option>Điện/ Điện tử</option>
                                        <option>Báo chí/ Truyền hình</option>
                                        <option>Bất động sản</option>
                                        <option>Công nghệ Ô tô</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="job-region">Vị trí</label><br>
                                    <select class="selectpicker border rounded" style="padding: 10px;" id="job-region"
                                            data-style="btn-black" data-width="100%" data-live-search="true"
                                            title="Select Region" name="position">
                                        <option>Thực tập sinh</option>
                                        <option>Nhân viên</option>
                                        <option>Phó phòng</option>
                                        <option>Trưởng phòng</option>
                                        <option>Trợ lý</option>
                                        <option>Thư ký</option>
                                        <option>Giám Đốc</option>
                                        <option>Quản lý</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-5 text-center">
                                <button class="btn btn-warning profile-button"
                                        type="submit">Lưu
                                    thông tin
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{--            <div class="col-md-8">--}}
            {{--                <div class="card card-user">--}}
            {{--                    <div class="card-header">--}}
            {{--                        <h5 class="card-title">Chỉnh sửa thông tin cá nhân</h5>--}}
            {{--                    </div>--}}
            {{--                    <div class="card-body">--}}
            {{--                        <div class="row" id="load-information">--}}
            {{--                            <div class="col-md-12">--}}
            {{--                                @foreach($type_infor as $type)--}}
            {{--                                    <form action="{{ Route('profile.update.information') }}" method="post">--}}
            {{--                                        @csrf--}}
            {{--                                        <div class="d-flex" style="justify-content:space-between;">--}}
            {{--                                            <label class="mt-4">{{ $type->content }}</label>--}}
            {{--                                            <div>--}}
            {{--                                                <button--}}
            {{--                                                    class="btn btn-sm btn-outline-success btn-round btn-icon mb-2 mt-4"--}}
            {{--                                                    id="btn-infor"><i class="fa fa-edit"></i></button>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                        <input type="hidden" name="role_id" value="{{ $user->role_id }}">--}}
            {{--                                        <input type="hidden" name="id" value="{{ $user->id }}">--}}
            {{--                                        <input type="hidden" name="type_id" value="{{ $type->id }}">--}}

            {{--                                        @if($information->isNotEmpty())--}}
            {{--                                            @foreach($information as $infor)--}}
            {{--                                                @if($infor->type_id == $type->id)--}}
            {{--                                                    <textarea type="text" class="form-control" name="content"--}}
            {{--                                                              rows="3">{{ $infor->content }}</textarea>--}}
            {{--                                                @else--}}
            {{--                                                    <textarea type="text" class="form-control" name="content"--}}
            {{--                                                              rows="3"></textarea>--}}
            {{--                                                @endif--}}
            {{--                                            @endforeach--}}
            {{--                                        @else--}}
            {{--                                            <textarea type="text" class="form-control" name="content"--}}
            {{--                                                      data-value=""></textarea>--}}
            {{--                                        @endif--}}
            {{--                                    </form>--}}
            {{--                                @endforeach--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>
    @include('layout.page-js')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<!-- @endsection -->
