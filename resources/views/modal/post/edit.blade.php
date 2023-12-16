<div class="modal fade" id="edit-post-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ Route('post.update') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$post->id}}">
                <input type="hidden" name="image" value="{{$post->image}}">
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="approved_user_id" value="{{$post->approved_user_id}}">
                <input type="hidden" name="user_id" value="{{$post->user_id}}">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa bài viết</h5>
                </div>

                <div style="padding: 20px">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tiêu đề:</label>
                        <textarea class="form-control" name="title">{{$post->title}}</textarea>
                    </div>
                    @error('title')
                    <div style="color:red;">{{ $message }}</div>
                    <br>
                    @enderror
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Mô tả:</label>
                        <textarea class="form-control" id="description" name="description">{{$post->description}}</textarea>
                    </div>
                    @error('description')
                    <div style="color:red;">{{ $message }}</div>
                    <br>
                    @enderror
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Lợi ích:</label>
                        <textarea class="form-control" id="benefit" name="benefit">{{$post->benefit}}</textarea>
                    </div>
                    @error('benefit')
                    <div style="color:red;">{{ $message }}</div>
                    <br>
                    @enderror
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Yêu cầu:</label>
                        <textarea class="form-control" id="requirements" name="requirements">{{$post->requirements}}</textarea>
                    </div>
                    @error('requirements')
                    <div style="color:red;">{{ $message }}</div>
                    <br>
                    @enderror
                    <div class="form-group">
                        <label for="job-description">Địa điểm làm việc</label><br>
                        <textarea class="form-control" name="workplace" rows="2">{{$post->workplace}}</textarea>
                    </div>
                    @error('workplace')
                    <div style="color:red;">{{ $message }}</div>
                    <br>
                    @enderror
                    <div class="form-group">
                        <label for="job-description">Số lượng</label><br>
                        <input type="number" name="quantity" value="{{$post->quantity}}">
                    </div>
                    @error('quantity')
                    <div style="color:red;">{{ $message }}</div>
                    <br>
                    @enderror
                    <div class="form-group">
                        <label for="job-description">Kinh nghiệm</label><br>

                        <input type="text" name="experience" value="{{$post->experience}}">
                    </div>
                    @error('experience')
                    <div style="color:red;">{{ $message }}</div>
                    <br>
                    @enderror
                    <div class="form-group">
                        <label for="job-type">Hình thức làm việc</label>
                        <select class="selectpicker" data-style="btn-black" data-width="100%" title="Select Job Type" name="working">
                            <option value="Bán thời gian">Bán thời gian</option>
                            <option>Toàn thời gian</option>
                            <option>Thực tập</option>
                            <option>Làm từ xa</option>
                        </select>

                        <select class=" border rounded" id="job-type" data-style="btn-black"
                                data-width="100%" data-live-search="true" title="Select Job Type" name="working">
                            <option>Bán thời gian</option>
                            <option>Toàn thời gian</option>
                            <option>Thực tập</option>
                            <option>Làm từ xa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="job-region">Chuyên ngành</label>
                        <select class=" border rounded" id="job-region" data-style="btn-black"
                                data-width="100%" data-live-search="true" title="Select Region" name="major">
                            <option>IT/ Công nghệ phần mềm</option>
                            <option>Kế toán</option>
                            <option>Makerting</option>
                            <option>Chế tạo máy</option>
                            <option>Điện/ Điện tử</option>
                            <option>Báo chí/ Truyền hình</option>
                            <option>Bất động sản</option>
                            <option>Công nghệ Ô tô</option>
                            <option>Cơ khí</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="job-region">Cấp bậc</label>
                        <select class=" border rounded" id="job-region" data-style="btn-black"
                                data-width="100%" data-live-search="true" title="Select Region" name="position">
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


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Chỉnh sửa bài viết</button>
                </div>

            </form>
        </div>
    </div>
</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
    CKEDITOR.replace('benefit');
    CKEDITOR.replace('requirements');
</script>

