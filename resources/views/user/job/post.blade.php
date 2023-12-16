@extends('company.layout')
@section('content')
    <link rel="stylesheet" href="{{ url('board-master/css/style.css') }}">
    <section class="site-section" style="background-color:white;padding-top:0rem;padding-bottom:0rem">
        <div class="row mb-5">
            <form class="p-4 p-md-5 " action="{{ route('post.create') }}" method="post">
                @csrf
                <div class="form-group" style="padding-top:10px">
                    <label class="pt-1 pb-1" for="job-description">Tiêu đề</label><br>
                    <textarea name="title" rows="3" cols="153"></textarea>
                </div>
                @error('title')
                <div style="color:red;">{{ $message }}</div>
                <br>
                @enderror
                <div class="form-group">
                    <label class="pt-3 pb-2" for="job-description">Mô tả</label>
                    <textarea name="description" id="description"></textarea>
                </div>
                @error('description')
                <div style="color:red;">{{ $message }}</div>
                <br>
                @enderror
                <div class="form-group">
                    <label class="pt-3 pb-2" for="job-description">Quyền lợi</label>
                    <textarea name="benefit" id="benefit"></textarea>
                </div>
                @error('benefit')
                <div style="color:red;">{{ $message }}</div>
                <br>
                @enderror
                <div class="form-group">
                    <label class="pt-3 pb-2" for="job-description">Kinh nghiệm</label><br>
                    <textarea name="experience" id="experience"></textarea>
                </div>
                @error('experience')
                <div style="color:red;">{{ $message }}</div>
                <br>
                @enderror
                <div class="form-group">
                    <label class="pt-3 pb-2" for="job-description">Yêu cầu</label>
                    <textarea name="requirements" id="requirements"></textarea>
                </div>
                @error('requirements')
                <div style="color:red;">{{ $message }}</div>
                <br>
                @enderror
                <div class="form-group" style="width:100%">
                    <label class="pt-3 pb-2" for="job-description">Địa điểm làm việc</label><br>
                    <input class="p-2" style="width:100%;border: 1px solid #dee2e6;border-radius:5px" type="text"
                           name="workplace" placeholder=" Địa chỉ công ty....."
                           cols="112">
                </div>
                @error('workplace')
                <div style="color:red;">{{ $message }}</div>
                <br>
                @enderror
                <div class="set-row">
                    <div class="form-group">
                        <label for="job-region">Chuyên ngành</label>
                        <select class="selectpicker border rounded" id="job-region" style="margin-right: -52px;"
                                data-style="btn-black" data-width="100%"
                                data-live-search="true" title="Select Region" name="major">
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
                    <div class="form-group" style="margin-left:100px;">
                        <label for="job-region">Cấp bậc</label>
                        <select class="selectpicker border rounded" id="job-region" data-style="btn-black"
                                data-width="100%"
                                data-live-search="true" title="Select Region" name="position">
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
                <div class="set-row">
                    <div class="form-group">
                        <label for="job-type">Hình thức làm việc</label>
                        <select class="selectpicker border rounded" id="job-type" data-style="btn-black"
                                data-width="100%"
                                data-live-search="true" title="Select Job Type" name="working">
                            <option>Bán thời gian</option>
                            <option>Toàn thời gian</option>
                            <option>Thực tập</option>
                            <option>Làm từ xa</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-left:101px;">
                        <label for="job-description">Số lượng</label><br>
                        <input style="height: 50px;border: 1px solid #dee2e6;border-radius:5px;width:113%" type="number"
                               name="quantity">
                        @error('quantity')
                        <div style="color:red;">{{ $message }}</div>
                        <br>
                        @enderror
                    </div>

                </div>

                <input type="hidden" name="user_id" value=" {{ Auth::user()->id }}">
                <button type="submit" class="btn "
                        style="position: relative;left: 45%;top: 20px;background:#89ba16;;color:white;">Tạo bài viết
                </button>
            </form>
        </div>
    </section>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
        CKEDITOR.replace('benefit');
        CKEDITOR.replace('requirements');
        CKEDITOR.replace('experience');
        experience
    </script>
@endsection
