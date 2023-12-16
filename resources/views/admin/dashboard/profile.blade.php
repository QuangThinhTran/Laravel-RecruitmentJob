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
                    <div class="card-body d-flex justify-content-center">
                        <form action="{{ Route('profile.update.basic') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container1" id="imgBox">
                                <label for="file">
                                    <img id="output" src="{{ url('image_avatar/') }}/{{ Auth::user()->img_avatar }}"
                                         width="225px"
                                         height="200px">
                                </label>
                                <input type="file" accept="image_avatar/*" name="img_avatar" id="file"
                                       onchange="loadFile(event)" style="display:none">
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
                            <div class="col-md-12">
                                <label>Nhập mật khẩu hiện tại</label>
                                <input type="password" style="width:100%" class="inputpass" name="password_old" placeholder="Mật khẩu tối thiểu 8 ký tự">
                                @error('password_old')
                                <div style="color:red;">{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label>Nhập mật khẩu mới</label>
                                <input type="password" style="width:100%" class="inputpass" name="password" placeholder="Mật khẩu tối thiểu 8 ký tự">
                                @error('password')
                                <div style="color:red;">{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label>Nhập lại mật khẩu mới</label>
                                <input type="password" style="width:100%" class="inputpass" name="password_confirmation"
                                       placeholder="Mật khẩu tối thiểu 8 ký tự">
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
                                        <input type="text" class="form-control" name="phone"
                                               value="{{ $user->username }}" readonly>
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
                                            name="major">
                                        <option @if($user->major == "IT/ Công nghệ phần mềm") selected @endif >IT/ Công
                                            nghệ phần mềm
                                        </option>
                                        <option @if($user->major == "Kế toán") selected @endif>Kế toán</option>
                                        <option @if($user->major == "Makerting") selected @endif>Makerting</option>
                                        <option @if($user->major == "Chế tạo máy") selected @endif>Chế tạo máy</option>
                                        <option @if($user->major == "Điện/ Điện tử") selected @endif>Điện/ Điện tử
                                        </option>
                                        <option @if($user->major == "Báo chí/ Truyền hình") selected @endif>Báo chí/
                                            Truyền hình
                                        </option>
                                        <option @if($user->major == "Bất động sản") selected @endif>Bất động sản
                                        </option>
                                        <option @if($user->major == "Công nghệ Ô tô") selected @endif>Công nghệ Ô tô
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="job-region">Vị trí</label><br>
                                    <select class="selectpicker border rounded" style="padding: 10px;" id="job-region"
                                            data-style="btn-black" data-width="100%" data-live-search="true"
                                            name="position">
                                        <option @if($user->position == "Thực tập sinh") selected @endif >Thực tập sinh
                                        </option>
                                        <option @if($user->position == "Nhân viên") selected @endif >Nhân viên</option>
                                        <option @if($user->position == "Phó phòng") selected @endif >Phó phòng</option>
                                        <option @if($user->position == "Trưởng phòng") selected @endif >Trưởng phòng
                                        </option>
                                        <option @if($user->position == "Trợ lý") selected @endif >Trợ lý</option>
                                        <option @if($user->position == "Thư ký") selected @endif >Thư ký</option>
                                        <option @if($user->position == "Giám Đốc") selected @endif >Giám Đốc</option>
                                        <option @if($user->position == "Quản lý") selected @endif >Quản lý</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="job-region">Mô tả</label><br>
                                    <textarea name="description" rows="5"
                                              style="width:100%">{{ $user->description }}</textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
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
        </div>
    </div>
    @include('layout.page-js')
    <script>
        var loadFile = function (event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
@endsection
