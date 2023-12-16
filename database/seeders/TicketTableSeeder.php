<?php

namespace Database\Seeders;

use App\Constant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;

class TicketTableSeeder extends Seeder
{
    use WithFaker;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $report_user = [
            'Có dấu hiện của lừa đảo',
            'Thông tin sai sự thật',
            'Thiếu trách nhiệm trong công việc',
            'Từng có tiền sử lừa đảo chiếm đoạt tài sản của công ty',
            'Đã từng biển thủ quỹ của công ty'
        ];

        for ($i = 1; $i <= 30; $i++) {
            DB::table('ticket')->insert([
                'content' => $report_user[rand(0,4)],
                'from_user_id' => rand(2,21),
                'to_user_id' => rand(2,21),
                'type_id' => Constant::TICKET_REPORT_USER,
                'created_at' => Carbon::now()->subWeek()
            ]);
        }

        $report_post = [
            'Không đúng sự thât',
            'Tuyển dụng vị trí này nhưng khi làm việc lại cho vị trí khác',
            'Công ty đa cấp',
            'Có dấu hiện của lừa đảo',
        ];

        for ($i = 1; $i <= 30; $i++) {
            DB::table('ticket')->insert([
                'content' => $report_post[rand(0,3)],
                'from_user_id' => rand(2,21),
                'post_id' => rand(1,16),
                'type_id' => Constant::TICKET_REPORT_POST,
                'created_at' => Carbon::now()->subWeek()
            ]);
        }

        $report_review = [
            'Ngôn từ không đứng đắn',
            'Công kích, xúc phạm người khác',
            'Ngôn từ tục tiểu, hạ thấp danh dự người khác'
        ];

        for ($i = 1; $i <= 30; $i++) {
            DB::table('ticket')->insert([
                'content' => $report_review[rand(0,2)],
                'from_user_id' => rand(2,21),
                'ticket_id' => rand(121,150),
                'type_id' => Constant::TICKET_REPORT_REVIEW,
                'created_at' => Carbon::now()->subWeek()
            ]);
        }

        $contact = [
            'Tôi rất thích trang Web này',
            'Hi vọng trang Web có thể phát triển thêm',
            'Tôi muốn khôi phục lại tài khoản của tôi',
            'Tôi muốn khôi phục lại bài viết của tôi'
        ];

        for ($i = 1; $i <= 30; $i++) {
            DB::table('ticket')->insert([
                'username' => vnfaker()->fullName(),
                'content' => $contact[rand(0,3)],
                'email' => fake()->email,
                'from_user_id' => rand(2,21),
                'type_id' => Constant::TICKET_CONTACT,
                'created_at' => Carbon::now()->subWeek()
            ]);
        }

        $review_candidate = [
            'Tinh thần trách nhiệm cao trong công việc',
            'Hoạt động nhóm rất tốt',
            'Không ngại học hỏi, cởi mở',
            'Tham gia tích cực các hoạt đông của công ty',
            'Có kiến thức chuyên môn tốt',
            'Chịu được áp lực cao trong công việc',
            'Thiếu kiến thức chuyên môn trầm trọng',
            'Không có trách nhiệm trong công việc',
            'Tâm lý yếu, không chịu được áp lực trong công việc',
            'Không tham gia các hoạt đông của công ty',
            'Tự ý nghỉ việc không xin phép',
            'Khả năng giao tiếp với đồng nghiệp và cấp trên yếu kém'
        ];

        for ($i = 1; $i <= 15; $i++) {
            DB::table('ticket')->insert([
                'content' => $review_candidate[rand(0,11)],
                'from_user_id' => rand(2,5),
                'to_user_id' => rand(6,21),
                'type_id' => Constant::TICKET_REVIEW,
                'created_at' => Carbon::now()->subWeek()
            ]);
        }

        $review_company = [
            'Chế độ đãi ngộ tốt',
            'Sếp quan tâm đến nhân viên',
            'Môi trường làm việc tốt, đồng nghiệp biết quan tâm nhau',
            'Công ty quan tâm đến giá trị mà nhân viên mang lại',
            'Lương trả khá hời',
            'Trả lương OT cao',
            'Chế độ đãi ngộ kém, công ty bóc lột nhân viên',
            'Sếp hay pressing nhân viên, pressing mọi lúc, mọi nơi',
            'Môi trường làm việc toxic, đấu đá nội bộ, rất nhiều drama',
            'Trả lương thì thấp, công việc thì nhiều',
            'Công ty hay quịt lương nhân viên',
            'Có bà lao công khó tính, suốt ngày chửi'
        ];

        for ($i = 1; $i <= 15; $i++) {
            DB::table('ticket')->insert([
                'content' => $review_company[rand(0,11)],
                'from_user_id' => rand(6,21),
                'to_user_id' => rand(2,5),
                'type_id' => Constant::TICKET_REVIEW,
                'created_at' => Carbon::now()->subWeek()
            ]);
        }

        for ($i = 1; $i <= 200; $i++) {
            DB::table('images')->insert([
                'image' => 'image-' . rand(1,20) . '.jpg',
                'ticket_id' => rand(1,90),
                'created_at' => Carbon::now()->subWeek()
            ]);
        }
    }
}
