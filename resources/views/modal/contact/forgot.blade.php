<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color:black">Quên mật khẩu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <label>Nhập email:</label>
                    <form action="{{ Route('send.forgot.mail') }}" method="post" id="forgot-mail">
                        @csrf
                        <input type="email" name="email" style="width: 80%;padding: 5px;border-radius: 5px;" required>
                        <button class="btn btn-outline-success" type="submit">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-body {
        background-color: #fff;
    }

    .modal-body input {
        text-align: center;
    }
</style>
