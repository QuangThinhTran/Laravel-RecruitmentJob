<div class="modal fade" id="modalReportPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ Route('report.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Báo cáo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Ảnh :</label>
                        <input type="file" class="form-control" name="image[]" multiple>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Nội dung :</label>
                        <textarea class="form-control" name="content" required></textarea>
                    </div>
                </div>
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ url('board-master/js/upload-image.js') }}"></script>
