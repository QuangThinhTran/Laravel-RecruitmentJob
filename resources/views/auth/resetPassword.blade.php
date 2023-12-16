<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<body>
<form action="{{ Route('handle.forgot') }}" class="form-master" method="post">
    @csrf
    <div class="container ">
        <h1> Đặt lại mật khẩu</h1>
    </div>
    <div class="container1">
        <div id="input-container">
            <label for="psw">Mật khẩu mới</label>
            <span><i class="fas fa-user-shield icon" style="color: #8ad760;"></i></span>
            <input class="input-field" type="password" name="password" placeholder="Mật khẩu tối thiểu 8 ký tự">
            @error('password')
            <div style="color:red;">{{ $message }}</div>
            <br>
            @enderror
        </div>
        <div id="input-container">
            <label for="psw">Nhập lại mật khẩu mới</label>
            <span><i class="fas fa-user-shield icon" style="color: #8ad760;"></i></span>
            <input class="input-field" type="password" name="password_confirmation" placeholder="Mật khẩu tối thiểu 8 ký tự">
            @error('password')
            <div style="color:red;">{{ $message }}</div>
            <br>
            @enderror
            <input type="hidden" name="email" value="{{ $email }}">
        </div>
    </div>
    <button class="col-md-9" type="submit">Đặt lại mật khẩu</button>
</form>
</body>
<style>


    body {
        background-color: #f3f5f7;
    }

    .form-master {
        background-color: white;
        min-height: 40vh;
        margin: 0 auto;
        padding: 30px;
        width: 600px;
        margin-top: 50px;
    }

    .container {
        margin-left: 115px;
    }

    .container1 {
        display: flex;
        flex-direction: column;
        color: #4d5965;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 20px
    }

    .container1 i {
        position: absolute;
        font-size: 22px;
    }

    button {
        background-color: #0ad865;
        position: relative;
        left: 12%;
        margin-top: 10px;
        padding: 7px;
        border-radius: 5px;
        color: white;
        border: none
    }

    .icon {
        padding: 10px;
        min-width: 40px;
    }

    #input-container {
        position: relative;
    }

    #input-container > span {
        position: absolute;
        top: 26px;
        left: 0px;
    }

    #input-container > input {
        padding-left: 40px;
        border-radius: 5px;
        width: 100%;
        height: 40px;
    }
</style>
