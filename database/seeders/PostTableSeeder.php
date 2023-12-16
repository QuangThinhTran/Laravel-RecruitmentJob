<?php

namespace Database\Seeders;

use App\Constant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostTableSeeder extends Seeder
{
    use WithFaker;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $title = 'Tuyển ';
        $benefit =
            '<p>- Bảo hiểm chăm sóc sức khỏe định kì hằng năm sau 2 tháng thử việc.</p>
            <p>- Thời gian nghỉ phép 12 ngày/năm</p>
            <p>- Nhiều chương trình thi đua khen thưởng, có cơ hội du lịch trong và ngoài nước 1 năm 4-5 lần.</p>
            <p>- Đào tạo kỹ năng, nghiệp vụ trước khi bắt đầu công việc (Đào tạo vẫn được chấm công như đi làm).</p>
            <p>- Được đóng các loại BHXH, BHYT, BHTN, bảo hiểm sức khỏe và các chế độ khác theo quy định của Công ty.</p>
            <p>- Thưởng: Tối thiểu 13 tháng lương, thưởng Tết, thưởng dự án, thưởng ngày lễ, thưởng giới thiệu nhân sự, thưởng khác</p>
            <p>- Tham gia các chương trình của công ty & chương trình nội bộ: Birthday party, Anniversary party, Sum-up party, Year-End party, Team Building,..</p>';

        $requirements =
            '<p>- Chịu khó học hỏi, có tinh thần cầu tiến</p>
             <p>- Trình độ chuyên môn: Cao đẳng, Đại học trở lên hoặc tốt nghiệp các chuyên ngành liên quan</p>
             <p>- Có giao tiếp Tiếng Anh tốt hoặc tối thiểu sử dụng email/ chat</p>
             <p>- Tính kỷ luật, trung thực, có tinh thần trách nhiệm cao</p>
             <p>- Kỹ năng giao tiếp tốt, có khả năng làm việc độc lập và làm việc nhóm</p>';

        $it = ['Java', 'VueJs', 'PHP Laravel', 'GameUnity', 'Nodejs', 'Python'];

        $street = [
            'Hoàng Hoa Thám',
            'Nguyễn Lý',
            'Nguyễn Thị Minh Khai',
            'An Dương Vương',
            'Nguyễn Thị Thập',
            'Hai Bà Trưng'
        ];
        $district = ['quận 1', 'quận 7', 'quận Thủ Đức', 'quận Bình Thạnh', 'quận Gò Vấp', 'quận Phú Nhuận'];
        $position = [
            'Nhân viên',
            'Thực tập sinh',
            'Phó phòng',
            'Trưởng phòng',
            'Trợ lý',
            'Thư ký',
            'Giám Đốc',
            'Quản lý'
        ];
        $time = [
          'Bán thời gian',
          'Toàn thời gian',
          'Thực tập',
          'Làm từ xa'
        ];
        $descriptionIT =
            '<p>- Phạm vi công việc từ làm rõ yêu cầu của khách hàng, viết tài liệu thiết kế hệ thống cho đến develop, testing, deploy và vận hành hệ thống cho khách hàng</p>
            <p>- Thiết kế, coding và kiểm thử hệ thống hoặc chức năng sau khi hoàn thành</p>
            <p>- Tham gia phát triển các dự án về Web, xây dựng các chức năng front-end của Website, Web application cho công ty</p>
            <p>- Phối hợp đội ngũ Back-end để triển khai và tích hợp API vào webiste, cải thiện tính năng, hiệu năng hệ thống trong quá trình vận hành</p>
            <p>- Tham gia tìm hiểu, phát triển công nghệ, sản phẩm phần mềm mới</p>
            <p>- Làm việc, phối hợp với nhóm để phát triển phần mềm chất lượng cao với hiệu suất tối ưu, khả năng mở rộng</p>';

        for ($i = 1; $i < 3; $i++) {
            DB::table('post')->insert([
                'title' => $title . 'Lập Trình Viên ' . $it[rand(0, 5)] . ' - Từ ' . rand(1, 5) . ' năm kinh nghiệm trở lên',
                'requirements' => $requirements,
                'description' => $descriptionIT,
                'benefit' => $benefit,
                'quantity' => rand(3, 5),
                'position' => $position[rand(0,7)],
                'workplace' => rand(50, 300) . ' ' . $street[rand(0, 5)] . ', ' . $district[rand(0, 5)] . ', TP Hồ Chí Minh',
                'experience' => rand(1,5) . ' năm',
                'working' => $time[rand(0,3)],
                'major' => Constant::MAJOR_IT,
                'status' => 1,
                'user_id' => rand(2, 5),
                'approved_user_id' => 1,
                'approved_date' => Carbon::now()->subWeek(),
                'created_at' => Carbon::now()->subWeek()
            ]);

            $descriptionNewspaper =
                '<p>- Tối ưu hóa nội dung cho SEO và phân phối trên các kênh truyền thông xã hội, website, và các nền tảng truyền thông khác</p>
            <p>- Xây dựng mối quan hệ với các phương tiện truyền thông, nhà báo để tăng cường sự xuất hiện và phát triển thương hiệu</p>
            <p>- Tạo ra nội dung sáng tạo và chất lượng, bao gồm bài viết, thông cáo báo chí, và các tài liệu truyền thông khác</p>
            <p>- Thực hiện nội dung bộ công cụ hỗ trợ bán hàng (tờ gấp/brochure, tờ rơi, website, thư ngỏ...); nội dung phục vụ sự kiện của dự án và công ty (MC Script, thiệp mời, standee, banner, backdrop, TCBC, bài phát biểu, các loại ấn phẩm khác...)</p>
            <p>- Xây dựng và duy trì mối quan hệ với các phương tiện truyền thông, nhà báo, và các đối tác liên quan. Viết, chuẩn bị và phân phối thông cáo báo chí, tư liệu PR, và các tài liệu truyền thông khác cho các phương tiện truyền thông</p>';

            DB::table('post')->insert([
                'title' => $title . 'Chuyên Viên Quan Hệ Báo Chí ' . '- Từ ' . rand(1, 5) . ' năm kinh nghiệm trở lên',
                'requirements' => $requirements,
                'description' => $descriptionNewspaper,
                'benefit' => $benefit,
                'quantity' => rand(3, 5),
                'position' => $position[rand(0,7)],
                'workplace' => rand(50, 300) . ' ' . $street[rand(0, 5)] . ', ' . $district[rand(0, 5)] . ', TP Hồ Chí Minh',
                'experience' => rand(1,5) . ' năm',
                'working' => $time[rand(0,3)],
                'major' => Constant::MAJOR_NEWSPAPERS,
                'status' => 1,
                'user_id' => rand(2, 5),
                'approved_user_id' => 1,
                'approved_date' => Carbon::now()->subWeek(),
                'created_at' => Carbon::now()->subWeek()
            ]);

            $descriptionElectronics =
                '<p>- Thường xuyên kiểm tra, kiểm soát hệ thống trang thiết bị điện, cơ sở vật chất cho các điểm kinh doanh, quầy hàng thuộc Công ty tại sân bay: điện, nước, điều hòa không khí, PCCC, Camera….đảm bảo hệ thống hoạt động thông suốt, đúng quy trình, quy chuẩn, an toàn và hiệu quả</p>
                <p>- Tổ chức lắp đặt, sửa chữa bảo trì và bảo dưỡng các thiết bị kỹ thuật theo sự phân công của Quản lý</p>
                <p>- Giám sát hoạt động của nhà thầu, khách hàng trong việc lắp đặt bảo trì bảo dưỡng, sửa chữa hệ thống thiết bị, đảm bảo không làm ảnh hưởng đến kết cấu và hệ thống thiết bị chung của các điểm kinh doanh</p>
                <p>- Theo dõi, khắc phục mọi sự cố phát sinh về quá trình vận hành của các thiết bị kỹ thuật tại các điểm kinh doanh</p>
                <p>- Các nhiệm vụ khác theo sự phân công của cấp trên</p>';

            DB::table('post')->insert([
                'title' => $title . 'Kỹ sư Điện-Điện tử ' . '- Từ ' . rand(1, 5) . ' năm kinh nghiệm trở lên',
                'requirements' => $requirements,
                'description' => $descriptionElectronics,
                'benefit' => $benefit,
                'quantity' => rand(3, 5),
                'position' => $position[rand(0,7)],
                'workplace' => rand(50, 300) . ' ' . $street[rand(0, 5)] . ', ' . $district[rand(0, 5)] . ', TP Hồ Chí Minh',
                'experience' => rand(1,5) . ' năm',
                'working' => $time[rand(0,3)],
                'major' => Constant::MAJOR_ELECTRONICS,
                'status' => 1,
                'user_id' => rand(2, 5),
                'approved_user_id' => 1,
                'approved_date' => Carbon::now()->subWeek(),
                'created_at' => Carbon::now()->subWeek()
            ]);

            $descriptionCar =
                '<p>- Tiếp nhận sửa chữa xe theo yêu cầu của Trưởng bộ phận và Ban lãnh đạo</p>
                <p>- Các dòng xe cần sửa như: Các dòng xe Đầu kéo Mỹ, Đầu kéo Trung quốc, Xe tải các loại, Sơ mi rơ mooc…</p>
                <p>- Ѕửa chữa ghế ô tô và nội thất ô tô</p>
                <p>- Đánh Ƅóng ô tô, chăm sóc ô tô, phủ ceramic</p>
                <p>- Sửa chữa và chăm sóc đồ da</p>';

            DB::table('post')->insert([
                'title' => $title . 'Kỹ Thuật Viên Ô Tô ' . '- Từ ' . rand(1, 5) . ' năm kinh nghiệm trở lên',
                'requirements' => $requirements,
                'description' => $descriptionCar,
                'benefit' => $benefit,
                'quantity' => rand(3, 5),
                'position' => $position[rand(0,7)],
                'workplace' => rand(50, 300) . ' ' . $street[rand(0, 5)] . ', ' . $district[rand(0, 5)] . ', TP Hồ Chí Minh',
                'experience' => rand(1,5) . ' năm',
                'working' => $time[rand(0,3)],
                'major' => Constant::MAJOR_CAR_TECHNOLOGY,
                'status' => 1,
                'user_id' => rand(2, 5),
                'approved_user_id' => 1,
                'approved_date' => Carbon::now()->subWeek(),
                'created_at' => Carbon::now()->subWeek()
            ]);

            $descriptionManufacturing =
                '<p>- Chịu trách nhiệm lập bản vẽ chi tiết, bản vẽ 2D, 3D theo yêu cầu của công ty và khách hàng</p>
                <p>- Lên bản vẽ thiết kế chi tiết, 2D, 3D theo yêu cầu từng đơn hàng</p>
                <p>- Phối hợp cùng bộ phận kinh doanh và bộ phận sản xuất xử lý các vấn đề liên quan đến bản vẽ</p>
                <p>- Đảm bảo số lượng, chất lượng sản phẩm theo yêu cầu của công ty. Báo cáo kịp thời cho Trưởng ca sản xuất hoặc bộ phận bảo trì khi gặp sự cố bất thường về máy móc thiết bị</p>
                <p>- Chịu trách nhiệm vận hành các thiết bị trong dây chuyền tự động hóa: tinh chế, đóng gói</p>
                <p>- Xử lý, sửa chửa, bảo dưỡng nhỏ và đề xuất phụ tùng thay thế cho thiết bị máy móc được phân công vận hành</p>';

            DB::table('post')->insert([
                'title' => $title . 'Kỹ Sư Cơ Khí Chế Tạo Máy - Cơ Điện Tử ' . '- Từ ' . rand(1, 5) . ' năm kinh nghiệm trở lên',
                'requirements' => $requirements,
                'description' => $descriptionManufacturing,
                'benefit' => $benefit,
                'quantity' => rand(3, 5),
                'position' => $position[rand(0,7)],
                'workplace' => rand(50, 300) . ' ' . $street[rand(0, 5)] . ', ' . $district[rand(0, 5)] . ', TP Hồ Chí Minh',
                'experience' => rand(1,5) . ' năm',
                'working' => $time[rand(0,3)],
                'major' => Constant::MAJOR_MANUFACTURING,
                'status' => 1,
                'user_id' => rand(2, 5),
                'approved_user_id' => 1,
                'approved_date' => Carbon::now()->subWeek(),
                'created_at' => Carbon::now()->subWeek()
            ]);

            $descriptionMarketing =
                '<p>- Xây dựng hình ảnh thương hiệu công ty với bộ nhận diện thương hiệu chỉn chu & thống nhất từ offline đến online</p>
                <p>- Lên kế hoạch hoạt động & ngân sách tương ứng. Giám sát về hiệu quả và chi phí các chiến dịch quảng cáo trên các kênh truyền thông số (Google Adwords, Facebook)</p>
                <p>- Xây dựng, quản lý, thực hiện nội dung của các kênh Social trên các nền tảng Facebook; Tiktok; Instagram (bao gồm viết nội dung, trình bày nội dung, ý tưởng về hình ảnh, nội dung seeding...)</p>
                <p>- Sáng tạo nội dung, hình ảnh gắn liền với nhận diện thương hiệu, dựng video marketing, short clip tạo kênh truyền thông lan tỏa đa nền tảng nhắm tới đối tượng khách hàng mục tiêu, tiềm năng của công ty</p>
                <p>- Chủ động tìm kiếm, tiếp cận khách hàng tiềm năng trên các nền tảng mạng xã hội bao gồm Google, Facebook, Youtube, Instagram, Zalo,…tương tác với khách hàng tiềm năng có nhu cầu</p>
                <p>- Giám sát hiệu quả SEO trên hệ thống website doanh nghiệp</p>
                <p>- Thu thập, phân tích thông tin thị trường, thông tin các chương trình marketing của các đối thủ cạnh tranh để lên kế hoạch triển khai chiến dịch cho công ty</p>
                <p>- Quản trị website, fanpage và các kênh truyền thông số của công ty.</p>';

            DB::table('post')->insert([
                'title' => $title . 'Chuyên viên Marketing ' . '- Từ ' . rand(1, 5) . ' năm kinh nghiệm trở lên',
                'requirements' => $requirements,
                'description' => $descriptionMarketing,
                'benefit' => $benefit,
                'quantity' => rand(3, 5),
                'position' => $position[rand(0,7)],
                'workplace' => rand(50, 300) . ' ' . $street[rand(0, 5)] . ', ' . $district[rand(0, 5)] . ', TP Hồ Chí Minh',
                'experience' => rand(1,5) . ' năm',
                'working' => $time[rand(0,3)],
                'major' => Constant::MAJOR_MARKETING,
                'status' => 1,
                'user_id' => rand(2, 5),
                'approved_user_id' => 1,
                'approved_date' => Carbon::now()->subWeek(),
                'created_at' => Carbon::now()->subWeek()
            ]);

            $descriptionAccountant =
                '<p>- Lập chứng từ bán hàng ( hóa đơn, phiếu giao hàng..)</p>
                <p>- Hạch toán thu nhập, chi phí, khấu hao, TSCĐ, công nợ, nghiệp vụ khác, thuế GTGT và báo cáo thuế, lập quyết toán công ty</p>
                <p>- Kiểm tra các định khoản nghiệp vụ phát sinh trong quá trình hoạt động của kế toán phần hành</p>
                <p>- Theo dõi công nợ Công ty, quản lý tổng quát công nợ, Xác định và đề xuất lập dự phòng hoặc xử lý công nợ phải thu khó đòi Công ty</p>
                <p>- Thực hiện các nhiệm vụ khác theo sự phân công của Kế toán trưởng và Ban lãnh đạo công ty tại từng thời điểm</p>
                <p>- Đề xuất các phương pháp hạch toán và chế độ báo cáo</p>
                <p>- Thống kê và tổng hợp số liệu kế toán khi có yêu cầu</p>
                <p>- Lưu trữ dữ liệu kế toán theo quy định</p>';

            DB::table('post')->insert([
                'title' => $title . 'Kế toán ' . '- Từ ' . rand(1, 5) . ' năm kinh nghiệm trở lên',
                'requirements' => $requirements,
                'description' => $descriptionAccountant,
                'benefit' => $benefit,
                'quantity' => rand(3, 5),
                'position' => $position[rand(0,7)],
                'workplace' => rand(50, 300) . ' ' . $street[rand(0, 5)] . ', ' . $district[rand(0, 5)] . ', TP Hồ Chí Minh',
                'experience' => rand(1,5) . ' năm',
                'working' => $time[rand(0,3)],
                'major' => Constant::MAJOR_ACCOUNTANT,
                'status' => 1,
                'user_id' => rand(2, 5),
                'approved_user_id' => 1,
                'approved_date' => Carbon::now()->subWeek(),
                'created_at' => Carbon::now()->subWeek()
            ]);

            $descriptionRealEstate =
                '<p>- Nắm bắt nhu cầu khách hàng, tư vấn cho khách hàng các giải pháp về mặt bằng</p>
                <p>- Thường xuyên tìm kiếm, khai thác, cập nhật thông tin những dự án bất động sản nhằm phục vụ tốt nhất cho việc tư vấn của công ty</p>
                <p>- Tìm hiểu nhu cầu, tư vấn đầu tư cho khách hàng</p>
                <p>- Quảng bá và kinh doanh các sản phẩm Bất Động Sản do Công ty phân phối</p>
                <p>- Chủ động tìm kiếm mở rộng thị trường và khách hàng tiềm năng</p>
                <p>- Khảo sát thị trường nhằm thu thập, cập nhật thông tin cần thiết</p>
                <p>- Chịu trách nhiệm về kết quả và hiệu quả công việc với cấp lãnh đạo trực tiếp</p>';

            DB::table('post')->insert([
                'title' => $title . 'Nhân viên kinh doanh bất động sản ' . '- Từ ' . rand(1, 5) . ' năm kinh nghiệm trở lên',
                'requirements' => $requirements,
                'description' => $descriptionRealEstate,
                'benefit' => $benefit,
                'quantity' => rand(3, 5),
                'position' => $position[rand(0,7)],
                'workplace' => rand(50, 300) . ' ' . $street[rand(0, 5)] . ', ' . $district[rand(0, 5)] . ', TP Hồ Chí Minh',
                'experience' => rand(1,5) . ' năm',
                'working' => $time[rand(0,3)],
                'major' => Constant::MAJOR_REAL_ESTATE,
                'status' => 1,
                'user_id' => rand(2, 5),
                'approved_user_id' => 1,
                'approved_date' => Carbon::now()->subWeek(),
                'created_at' => Carbon::now()->subWeek()
            ]);
        }
    }
}
