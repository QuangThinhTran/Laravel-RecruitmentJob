<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ Route('admin.replied.report') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Phản hồi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" style="font-weight: bold;">Nội dung :
                        </label>
                    </div>
                    <textarea name="content" cols="60" rows="4" required></textarea>
                    <div id="replied_report"></div>
                </div>
                <input type="hidden" name="admin_id" value="{{ Auth::user()->id }}">
                <div class="modal-footer">
                    <div style="position:absolute;right: 14px;margin-top:20px">
                        <button type="submit" class="btn btn-primary">Phản hồi</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
