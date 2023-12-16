<!DOCTYPE html>
<html lang="en">

<head>
    <title>ĐĂNG KÝ</title>
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    @include('layout.page-css')
</head>

<style>
body {
    font-family: Arial;
}
.login-now{
    color:white;
}
.login-now a{
    color:#00c6d7;
}
</style>
<link rel="stylesheet" href="{{ url('Register/css/lg-res.css') }}" type="text/css" media="all" />
<body>
@include('sweetalert::alert')
    <!--header-->
    <div class="header-w3l">
        <h1>Đăng ký</h1>
    </div>
    <!--//header-->

    <!--main-->
    <div class="main-w3layouts-agileinfo">
        <!--form-stars-here-->
        <div class="wthree-form">
            <h2>Điền đầy đủ các thông tin trước khi đăng ký</h2>
            <div class="tab">
                <button class="tablinks active" onclick="openCity(event, 'London')">Nhà tuyển dụng</button>
                <button class="tablinks" onclick="openCity(event, 'Paris')">Ứng viên</button>
            </div>

            <div id="London" class="tabcontent" style="display:block;">

                <form action="{{ route('user.register') }}" method="post">
                    @csrf
                    <div class="form-sub-w3">
                        <input type="text" name="name" placeholder="Tên doanh nghiệp" />
                    </div>
                    @error('name')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="text" name="username" placeholder="Tên đăng nhập " />
                    </div>
                    @error('username')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="text" name="email" placeholder="Email"/>
                    </div>
                    @error('email')
                    <div style="color:red;" >{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="text" name="phone" placeholder="Số điện thoại" />
                    </div>
                    @error('phone')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="text" name="address" placeholder="Địa chỉ" />
                    </div>
                    @error('address')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="password" name="password" placeholder="Mật khẩu ( tối thiểu 8 ký tự )" />
                    </div>
                    @error('password')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu " />
                    </div>
                    @error('password_confirmation')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    @if(session('Error'))
                    <p style="color:red">{{session('Error')}}</p>
                    @endif
                    <input type="hidden" name="role_id" value="2">
                    <div class="clear"></div>
                    <div class="login-now" >
                        <p style="color: black">Bạn đã có tài khoản ?<a href="{{ Route('user.login') }}"> đăng nhập ngay</a></p>
                    </div>
                    <div class="submit-agileits">
                        <input type="submit" value="Đăng kí">
                    </div>
                </form>
            </div>
            <div id="Paris" class="tabcontent">
                <form action="{{ route('user.register') }}" method="post">
                    @csrf
                    <div class="form-sub-w3">
                        <input type="text" name="name" placeholder="Tên hiển thị" />
                    </div>
                    @error('name')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="text" name="username" placeholder="Tên đăng nhập " />
                    </div>
                    @error('username')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="text" name="email" placeholder="Email" />
                    </div>
                    @error('email')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="text" name="phone" placeholder="Số điện thoại" />
                    </div>
                    @error('phone')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="text" name="address" placeholder="Địa chỉ" />
                    </div>
                    @error('address')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="password" name="password" placeholder="Mật khẩu ( tối thiểu 8 ký tự )" />
                    </div>
                    @error('password')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    <div class="form-sub-w3">
                        <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu " />
                    </div>
                    @error('password_confirmation')
                    <div style="color:red;">{{ $message }}</div><br>
                    @enderror
                    @if(session('Error'))
                        <p style="color:red">{{session('Error')}}</p>
                    @endif
                    <div class="clear"></div>
                    <div class="login-now" >
                        <p style="color: black">Bạn đã có tài khoản ?<a href="{{ Route('user.login') }}"> đăng nhập ngay</a></p>
                    </div>
                    <input type="hidden" name="role_id" value="3">
                    <div class="submit-agileits">
                        <input type="submit" value="Đăng kí">
                    </div>
                </form>
            </div>
        </div>
        <!--//form-ends-here-->
    </div>
    <!--//main-->
    <!--footer-->
    <div class="footer">
        <p>&copy; 2017 Glassy Login Form. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a>
        </p>
    </div>
    <!--//footer-->
</body>
<script>
    $(document).ready(() => {
        $("#contact").validate({
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

        $("#type").validate({
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
    })
</script>

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
    console.log(cityName)
}
/*
We want to preview images, so we need to register the Image Preview plugin
*/
FilePond.registerPlugin(

    // encodes the file as base64 data
    FilePondPluginFileEncode,

    // validates the size of the file
    FilePondPluginFileValidateSize,

    // corrects mobile image orientation
    FilePondPluginImageExifOrientation,

    // previews dropped images
    FilePondPluginImagePreview
);

// Select the file input and use create() to turn it into a pond
FilePond.create(
    document.querySelector('input')
);
</script>

</html>
