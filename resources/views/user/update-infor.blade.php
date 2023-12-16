<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    @include('layout.page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
    .site-navbar {
    margin-bottom: 0px;
    z-index: 1999;
    position: absolute;
    width: 100%;
    top: -4rem;
}
    .content-item {
        padding: 30px 0;
        background-color: #FFFFFF;
    }

    .content-item.grey {
        background-color: #F0F0F0;
        padding: 50px 0;
        height: 100%;
    }

    .content-item h2 {
        font-weight: 700;
        font-size: 35px;
        line-height: 45px;
        text-transform: uppercase;
        margin: 20px 0;
    }

    .content-item h3 {
        font-weight: 400;
        font-size: 20px;
        color: #555555;
        margin: 10px 0 15px;
        padding: 0;
    }

    .content-headline {
        height: 1px;
        text-align: center;
        margin: 20px 0 70px;
    }

    .content-headline h2 {
        background-color: #FFFFFF;
        display: inline-block;
        margin: -20px auto 0;
        padding: 0 20px;
    }

    .grey .content-headline h2 {
        background-color: #F0F0F0;
    }

    .content-headline h3 {
        font-size: 14px;
        color: #AAAAAA;
        display: block;
    }


    #comments {
        box-shadow: 0 -1px 6px 1px rgba(0, 0, 0, 0.1);
        background-color: #FFFFFF;
    }

    #comments form {
        margin-bottom: 30px;
    }

    #comments .btn {
        margin-top: 7px;
    }

    #comments form fieldset {
        clear: both;
    }

    #comments form textarea {
        height: 100px;
    }

    #comments .media {
        border-top: 1px dashed #DDDDDD;
        padding: 20px 0;
        margin: 0;
    }

    #comments .media > .pull-left {
        margin-right: 20px;
    }

    #comments .media img {
        max-width: 100px;
    }

    #comments .media h4 {
        margin: 0 0 10px;
    }

    #comments .media h4 span {
        font-size: 14px;
        float: right;
        color: #999999;
    }

    #comments .media p {
        margin-bottom: 15px;
        text-align: justify;
    }

    #comments .media-detail {
        margin: 0;
    }

    #comments .media-detail li {
        color: #AAAAAA;
        font-size: 12px;
        padding-right: 10px;
        font-weight: 600;
    }

    #comments .media-detail a:hover {
        text-decoration: underline;
    }

    #comments .media-detail li:last-child {
        padding-right: 0;
    }

    #comments .media-detail li i {
        color: #666666;
        font-size: 15px;
        margin-right: 10px;
    }
</style>
<header class="site-navbar mt-3" id="top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="site-logo col-6"><a style="color:white">Finding Job</a></div>
            <nav class="mx-auto site-navigation">
                <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
                    <li><a href="{{ Route('home') }}" class="nav-link active">Trang chủ</a></li>
                    <li class="has-children">
                        <a href="{{ Route('contact.index') }}">Liên hệ</a>
                    </li>
                </ul>
            </nav>

            @if(Auth::check() && Auth::user()->role_id == 1)
                <div class="right-cta-menu text-right d-flex aligin-items-center col-6 d-none d-xl-block">
                    <div class="ml-auto">
                        <form action="{{ Route('dashboard.index') }}" method="get">
                            <button type="submit" class="btn btn-primary text-white">
                                <input type="hidden" name="admin_id" value="{{ Auth::user()->role_id }}">
                                <i class="fas fa-home"> Trở về</i>
                            </button>
                        </form>
                    </div>
                </div>
            @elseif(Auth::check() && Auth::user()->role_id == 2)
                <div class="right-cta-menu text-right d-flex aligin-items-center col-6 d-none d-xl-block">
                    <div class="ml-auto">
                        <form action="{{ Route('company.index') }}" method="get">
                            <button type="submit" class="btn btn-primary text-white">
                                {{--                                <input type="hidden" name="admin_id" value="{{ Auth::user()->role_id }}">--}}
                                <i class="fas fa-home"> Trở về</i>
                            </button>
                        </form>
                    </div>
                </div>
            @elseif(Auth::check())
                <div class="right-cta-menu text-right d-flex aligin-items-center col-6 d-none d-xl-block">
                    <div class="ml-auto">
                        <a class="btn btn-success border-width-2 d-none d-lg-inline-block " href="" role="button"
                           data-toggle="dropdown" aria-expanded="false">
                            <span class=" icon-line-profile-male"></span>
                            {{ Auth::user()->username }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ Route('profile.index',['id' => Auth::user()->id]) }}">Thông
                                tin cá nhân</a>
                            <a class="dropdown-item" href="{{ Route('logout') }}">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
                    <div class="ml-auto">
                        <a href="{{ Route('user.login') }}"
                           class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span
                                class="mr-2 icon-lock_outline"></span>Đăng nhập</a>
                        <a href="{{ Route('user.register') }}"
                           class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span
                                class="mr-2 icon-contacts"></span>Đăng kí</a>
                    </div>
                    <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span
                            class="icon-menu h3 m-0 p-0 mt-2"></span></a>
                </div>
            @endif
        </div>
    </div>
</header>
<body>
@include('sweetalert::alert')
<div class="container rounded bg-white" style="margin-top:85px">
    <div class="row mt-3" >
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <form action="{{ Route('profile.update.basic') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="container1" id="imgBox">
                                <label for="file">
                                    <img id="output"src="{{ url('image_avatar/') }}/{{ Auth::user()->img_avatar }}" width="200px"
                                         height="200px">
                                </label>
                                <input type="file" accept="image_avatar/*" name="img_avatar" id="file" onchange="loadFile(event)" style="display:none">
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
        <div class="col-md-9 border-right">
            <div class="p-3 py-5">
                <div class="tab" style="display:flex;">
                    <button class="tablinks active" onclick="openCity(event, 'London')" style="font-size:15px">Thông tin cá nhân</button>
                    <button class="tablinks" onclick="openCity(event, 'Paris')" style="font-size:15px">Thông tin thêm</button>
                    <button class="tablinks" onclick="openCity(event, 'Tokyo')" style="font-size:15px">Đánh giá</button>
                    <button class="tablinks" onclick="openCity(event, 'France')" style="font-size:15px">Đổi mật khẩu</button>
                    <button class="tablinks" onclick="openCity(event, 'VietNam')" style="font-size:15px">Phản hồi</button>
                </div>

                <div id="London" class="tabcontent" style="display:block">
                    <form action="{{ Route('profile.update') }}" method="post">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tên đăng nhập</label><br>
                                    <!-- <label style="color: black;font-size: 20px">{{ $user->username }}</label> -->
                                    <input type="text" class="form-control" name="phone" value="{{ $user->username }}" readonly>
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
                                        data-style="btn-black" data-width="100%" data-live-search="true" name="major">
                                    <option @if($user->major == "IT/ Công nghệ phần mềm") selected @endif >IT/ Công nghệ phần mềm</option>
                                    <option @if($user->major == "Kế toán") selected @endif>Kế toán</option>
                                    <option @if($user->major == "Makerting") selected @endif>Makerting</option>
                                    <option @if($user->major == "Chế tạo máy") selected @endif>Chế tạo máy</option>
                                    <option @if($user->major == "Điện/ Điện tử") selected @endif>Điện/ Điện tử</option>
                                    <option @if($user->major == "Báo chí/ Truyền hình") selected @endif>Báo chí/ Truyền hình</option>
                                    <option @if($user->major == "Bất động sản") selected @endif>Bất động sản</option>
                                    <option @if($user->major == "Công nghệ Ô tô") selected @endif>Công nghệ Ô tô</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="job-region">Vị trí</label><br>
                                <select class="selectpicker border rounded" style="padding: 10px;" id="job-region"
                                        data-style="btn-black" data-width="100%" data-live-search="true" name="position">
                                    <option @if($user->position == "Thực tập sinh") selected @endif >Thực tập sinh</option>
                                    <option @if($user->position == "Nhân viên") selected @endif >Nhân viên</option>
                                    <option @if($user->position == "Phó phòng") selected @endif >Phó phòng</option>
                                    <option @if($user->position == "Trưởng phòng") selected @endif >Trưởng phòng</option>
                                    <option @if($user->position == "Trợ lý") selected @endif >Trợ lý</option>
                                    <option @if($user->position == "Thư ký") selected @endif >Thư ký</option>
                                    <option @if($user->position == "Giám Đốc") selected @endif >Giám Đốc</option>
                                    <option @if($user->position == "Quản lý") selected @endif >Quản lý</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Mô tả</label><br>
                                <textarea name="description"cols="102" rows="7">{{ $user->description }}</textarea>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button"
                                    type="submit">Lưu
                                thông tin
                            </button>
                        </div>
                    </form>
                </div>

                <div id="Paris" class="tabcontent">
                    <div class="row" id="load-information">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                @foreach($information as $infor)
                                    @if($infor->content == null)

                                    @else
                                        <label
                                            style="font-size: 17px; margin-top: 15px;">{{ $infor->type->content ?? null }}</label>
                                        <br>
                                    @endif
                                    <label
                                        style="font-weight: bold;font-size: 15px;color: black">{{ $infor->content }}</label>
                                    <br>
                                @endforeach

                                <form action="{{ Route('profile.update.information') }}" method="post">
                                    @csrf
                                    <div class="d-flex" style="justify-content:space-between;">
                                        <select class="selectpicker border rounded"
                                                style=" padding: 10px; width: 30%; margin-top: 25px;"
                                                id="job-region"
                                                data-style="btn-black" data-live-search="true"
                                                title="Select Region" name="type_id">
                                            @foreach($type_infor as $type)
                                                <option value="{{ $type->id }}">{{ $type->content }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <textarea type="text" class="form-control" name="content" style="margin-top: 15px;"
                                              rows="3"></textarea>
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="submit" style="margin-top: 15px;"
                                            class="btn btn-sm btn-outline-success">Lưu thông tin
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="Tokyo" class="tabcontent">
                    <section class="content-item" id="comments">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>{{ $count_review }} bình luận</h3>
                                    <div id="review">
                                        @foreach($reviews as $review)
                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img class="media-object" src="{{ url('image_avatar') }}/{{ $review->from_user->img_avatar }}" alt="">
                                                </a>
                                                <div class="media-body">
                                                    <div id="report_user" style="display:flex;justify-content:space-between">

                                                            <h4 class="media-heading" style="color: black;margin-top:10px">{{ $review->from_user->username }}</h4>
                                                            <a class="btn btn-light mb-4" role="button" data-toggle="dropdown"
                                                               aria-expanded="false" style=""   ><i class="fas fa-bars"></i></a>
                                                            <div class="dropdown-menu">
                                                                <button type="submit" class="dropdown-item" data-toggle="modal"
                                                                        value="{{ $review->from_user_id }},{{ $review->id }}"
                                                                        data-target="#modalCompanyReport" id="company_report_user">Báo cáo
                                                                </button>
                                                            </div>
                                                    </div>
                                                    <p>{{ $review->content }}</p>
                                                    <ul class="list-unstyled list-inline media-detail pull-left"
                                                        style="display: flex">
                                                        <li>
                                                            <i class="fa fa-calendar"></i>{{ $review->created_at->format('d-m-Y') }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    @if(Auth::user()->id == $user->id)
                                    @else
                                        <form id="create-review">
                                            <h3 class="pull-left">Bình luận mới</h3>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-sm-3 col-lg-2 hidden-xs">
                                                        <img class="img-responsive"
                                                             src="{{ url('image_avatar/') }}/{{ Auth::user()->img_avatar }}"
                                                             alt="">
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                                    <textarea class="form-control" id="message"
                                                              placeholder="Bình luận tại đây" required=""></textarea>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-success pull-right">Đăng</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div id="France" class="tabcontent">
                    <div class="col mt-3">
                        <form action="{{ Route('password.update') }}" method="post">
                            @csrf
                            <div class="col-md-6" style="margin-left:25%">
                                <label>Nhập mật khẩu hiện tại</label>
                                <input type="password" class="inputpass" name="password_old">
                                @error('password_old')
                                <div style="color:red;">{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                            <div class="col-md-6" style="margin-left:25%">
                                <label>Nhập mật khẩu mới</label>
                                <input type="password" class="inputpass" name="password">
                                @error('password')
                                <div style="color:red;">{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                            <div class="col-md-6" style="margin-left:25%">
                                <label>Nhập lại mật khẩu mới</label>
                                <input type="password" class="inputpass" name="password_confirmation">
                                @error('password_confirmation')
                                <div style="color:red;">{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="mt-2 text-center">
                                <button class="btn btn-primary profile-button"
                                        type="submit">Xác nhận
                                </button>
                                @if(session('Error'))
                                    <p style="color:red">{{session('Error')}}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div id="VietNam" class="tabcontent">
                    <section class="content-item" id="comments">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div>
                                        @foreach($admin_replied as $replied)
                                            <div class="media">
                                                <a class="pull-left" href="#"><img class="media-object"
                                                                                   src="{{ url('image_avatar') }}/{{ $replied->from_user->img_avatar}}"></a>
                                                <div class="media-body">
                                                    <h4 class="media-heading" style="font-size: 20px;color: black">Hệ thống Finding Job</h4>
                                                    <p>{{ $replied->content }}</p>
                                                    <ul class="list-unstyled list-inline media-detail pull-left"
                                                        style="display: flex;">
                                                        <li>
                                                            <i class="fa fa-calendar"></i>{{ $replied->created_at->format('d-m-Y') }}
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@include('modal.report.company_report')
@include('layout.page-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
<script>
    var imgBox = document.getElementById("imgBox");

    var loadFile = function (event) {
        imgBox.style.backgroundImage = "url(" + URL.createObjectURL(event.target.files[0]) + ")";
    }

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    $(document).ready(() => {
        $("#content-information").validate({
            rule: {
                content: "required"
            },
            messages: {
                content: "Vui lòng nhập nội dung"
            },
            errorElement: "p",
            errorPlacement: function (error, element) {
                var placement = $(element).data("error");
                if (placement) {
                    $(placement).append(error);
                } else {
                    error.insertAfter(element);
                }
            },
        });

        function load_information() {
            var _li = '';
            var _ht = '';
            $.get('{{ Route('profile.index', Auth::user()->id) }}', (res) => {
                var data = res.type_infor;
                var type = res.information;
                console.log(type);
                data.forEach(function (item) {
                    _li += '<div class="col-md-12 m-3">'
                    _li += '    <div class="d-flex m-0" style="justify-content:space-between;">';
                    _li += '        <label>' + item.content + '</label>';
                    _li += '            <div>';
                    _li += '                <button class="btn btn-sm btn-outline-success btn-round btn-icon mb-3" id="btn-infor"> <i class="fa fa-edit"></i></button>';
                    _li += '                <button class="btn btn-sm btn-outline-success btn-round btn-icon mb-3" id="btn-infor"> <i class="fas fa-trash-alt"></i></button>';
                    _li += '            </div>';
                    _li += '    </div>';
                    _li += '<input type="text" class="form-control" name="content" value="">';
                    _li += '</div>';
                    $('#load-information').html(_li);
                })
            });
        }

        $('#add-infor').submit(function (e) {
            e.preventDefault();
            var value = {
                "id": {{ Auth::user()->id }},
                "content": $("#content-information").val(),
                "type_id": $("#information_type option:selected").val(),
                "_token": "{{ csrf_token() }}",
            }
            $.ajax({
                url: '{{ Route('profile.update.information') }}',
                type: 'POST',
                data: value,
                success: function (res) {
                    load_information()
                }
            })
        })

        $('#report_user').on('click', '#company_report_user', function () {
            var data = $(this).val().split(',')
            var id = data[0]
            var ticket_id = data[1]
            var _li = '';
            _li += '<input type="hidden" name="to_user_id" value="' + id + '">';
            _li += '<input type="hidden" name="ticket_id" value="' + ticket_id + '">';
            $('#company-report').html(_li)
        })
    });
</script>
<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
</html>
