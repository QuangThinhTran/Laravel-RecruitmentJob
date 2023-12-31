<div class="modal fade" id="modalRepliedContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ Route('admin.replied.contact') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Phản hồi liên hệ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" style="font-weight: bold;">Nội dung : </label>
                    </div>
                    <textarea name="content" cols="60" rows="4" required></textarea>
                </div>
                <div id="replied_contact"></div>
                <input type="hidden" name="username" value="{{ Auth::user()->username }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="admin_id" value="{{ Auth::user()->id }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Phản hồi</button>
                </div>
            </form>
        </div>
    </div>
</div>
