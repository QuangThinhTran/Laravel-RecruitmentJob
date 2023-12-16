<?php

namespace Database\Seeders;

use App\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;

class TicketTypeTableSeeder extends Seeder
{
    use WithFaker;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            switch ($i)
            {
                case Constant::TICKET_REPORT_USER:
                    DB::table('ticket_type')->insert([
                        'content' => 'Báo cáo người dùng',
                    ]);
                    break;
                case Constant::TICKET_REPORT_POST:
                    DB::table('ticket_type')->insert([
                        'content' => 'Báo cáo bài viết',
                    ]);
                    break;
                case Constant::TICKET_CONTACT:
                    DB::table('ticket_type')->insert([
                        'content' => 'Liên hệ',
                    ]);
                    break;
                case Constant::TICKET_REVIEW:
                    DB::table('ticket_type')->insert([
                        'content' => 'Đánh giá',
                    ]);
                    break;
                case Constant::TICKET_REPORT_REVIEW:
                    DB::table('ticket_type')->insert([
                        'content' => 'Báo cáo đánh giá',
                    ]);
                    break;
            }
        }
    }
}
