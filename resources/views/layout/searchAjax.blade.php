<div class="row align-items-center justify-content-center pt-5">
    <div class="col-md-9">
        <form action="{{ Route('search.layout.filter') }}" method="post" class="search-jobs-form">
            @csrf
            <div class="row mb-5">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <input type="text" class="form-control form-control-lg input-search">

                    <div class="search-ajax-result" style="background:white;">

                    </div>

                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <select class="selectpicker" data-style="btn-white btn-lg" data-width="30%"
                            data-live-search="true" title="Select Region" name="major">
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
                <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4 mb-lg-0">
                    <select class="selectpicker" data-style="btn-white btn-lg" data-width="30%"
                            data-live-search="true" title="Select Job Type" name="working">
                        <option>Bán thời gian</option>
                        <option>Toàn thời gian</option>
                        <option>Thực tập</option>
                        <option>Làm từ xa</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4 mb-lg-0">
                    <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%"
                            data-live-search="true" title="Select Job Type" name="position">
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
                <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4 mb-lg-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search">
                        <span class="icon-search icon mr-2"></span>Tìm kiếm
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    .Scroll {
        height: 350px;
        overflow-y: scroll;
    }
</style>
