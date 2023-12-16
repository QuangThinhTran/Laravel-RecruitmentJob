@extends('company.layout')
@section('content')
    <link rel="stylesheet" href="{{ url('board-master/css/style.css') }}">
    <section class="site-section" style="background-color:white;padding-top:0rem;padding-bottom:0rem">
        <div class="row mb-5">
            <form class="p-4 p-md-5 " action="{{ route('post.update',['id' => $post->id]) }}" method="post">
                @csrf
                <div class="form-group" style="padding-top:10px">
                    <label class="pt-1 pb-1" for="job-description">Tiêu đề</label><br>
                    <textarea name="title" rows="3" cols="153">{{ $post->title }}</textarea>
                </div>

                <div class="form-group" >
                    <label class="pt-3 pb-2" for="job-description">Mô tả</label>
                    <textarea name="description" id="description">{{ $post->description }}</textarea>
                </div>

                <div class="form-group">
                    <label class="pt-3 pb-2" for="job-description">Quyền lợi</label>
                    <textarea name="benefit" id="benefit">{{ $post->benefit }}</textarea>

                </div>
                <div class="form-group">
                    <label class="pt-3 pb-2" for="job-description">Kinh nghiệm</label><br>
                    <textarea name="experience" id="experience">{{ $post->experience }}</textarea>
                </div>


                <div class="form-group">
                    <label class="pt-3 pb-2" for="job-description">Yêu cầu</label>
                    <textarea name="requirements" id="requirements">{{ $post->requirements }}</textarea>
                </div>

                <div class="form-group" style="width:100%">
                    <label class="pt-3 pb-2" for="job-description">Địa điểm làm việc</label><br>
                    <input class="p-2" style="width:100%;border: 1px solid #dee2e6;border-radius:5px" type="text" name="workplace" value="{{ $post->workplace }}"
                           cols="112">
                </div>
                <div class="set-row">
                    <div class="form-group">
                        <label for="job-region">Chuyên ngành</label>
                        <select class="selectpicker border rounded" id="job-region" style="margin-right: -52px;" data-style="btn-black" data-width="100%"
                                data-live-search="true" title="{{ $post->major }}" name="major" >
                            <option @if($post->major == "IT/ Công nghệ phần mềm") selected @endif >IT/ Công nghệ phần mềm</option>
                            <option @if($post->major == "Kế toán") selected @endif>Kế toán</option>
                            <option @if($post->major == "Makerting") selected @endif>Makerting</option>
                            <option @if($post->major == "Chế tạo máy") selected @endif>Chế tạo máy</option>
                            <option @if($post->major == "Điện/ Điện tử") selected @endif>Điện/ Điện tử</option>
                            <option @if($post->major == "Báo chí/ Truyền hình") selected @endif>Báo chí/ Truyền hình</option>
                            <option @if($post->major == "Bất động sản") selected @endif>Bất động sản</option>
                            <option @if($post->major == "Công nghệ Ô tô") selected @endif>Công nghệ Ô tô</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-left:100px;">
                        <label for="job-region">Cấp bậc</label>
                        <select class="selectpicker border rounded" id="job-region" data-style="btn-black" data-width="100%"
                                data-live-search="true" title="{{ $post->position }}" name="position">
                            <option @if($post->position == "Thực tập sinh") selected @endif >Thực tập sinh</option>
                            <option @if($post->position == "Nhân viên") selected @endif >Nhân viên</option>
                            <option @if($post->position == "Phó phòng") selected @endif >Phó phòng</option>
                            <option @if($post->position == "Trưởng phòng") selected @endif >Trưởng phòng</option>
                            <option @if($post->position == "Trợ lý") selected @endif >Trợ lý</option>
                            <option @if($post->position == "Thư ký") selected @endif >Thư ký</option>
                            <option @if($post->position == "Giám Đốc") selected @endif >Giám Đốc</option>
                            <option @if($post->position == "Quản lý") selected @endif >Quản lý</option>
                        </select>
                    </div>
                </div>
                <div class="set-row">
                    <div class="form-group">
                        <label for="job-type">Hình thức làm việc</label>
                        <select class="selectpicker border rounded" id="job-type" data-style="btn-black" data-width="100%"
                                data-live-search="true" title="{{ $post->working }}" name="working">
                            <option @if($post->working == "Bán thời gian") selected @endif>Bán thời gian</option>
                            <option @if($post->working == "Toàn thời gian") selected @endif>Toàn thời gian</option>
                            <option @if($post->working == "Thực tập") selected @endif>Thực tập</option>
                            <option @if($post->working == "Làm từ xa") selected @endif>Làm từ xa</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-left:101px;">
                        <label for="job-description">Số lượng</label><br>
                        <input style="height: 50px;border: 1px solid #dee2e6;border-radius:5px;width:113%" type="number" name="quantity" value="{{ $post->quantity }}">
                    </div>
                </div>
                <button type="submit" class="btn "  style="position: relative;left: 45%;top: 20px;background:#89ba16;;color:white;">Chỉnh sửa bài viết</button>
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
