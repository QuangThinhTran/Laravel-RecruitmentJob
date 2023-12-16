<?php

namespace Database\Seeders;

use App\Constant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    use WithFaker;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $street = ['Hoàng Hoa Thám', 'Nguyễn Lý', 'Nguyễn Thị Minh Khai', 'An Dương Vương', 'Nguyễn Thị Thập', 'Hai Bà Trưng'];
        $district = ['quận 1', 'quận 7', 'quận Thủ Đức', 'quận Bình Thạnh', 'quận Gò Vấp', 'quận Phú Nhuận'];
        $description = [
            'Tinh thần trách nhiệm cao trong công việc',
            'Hoạt động nhóm rất tốt',
            'Không ngại học hỏi, cởi mở',
            'Tham gia tích cực các hoạt đông của công ty',
            'Có kiến thức chuyên môn tốt',
            'Chịu được áp lực cao trong công việc',
            'Không ngại học hỏi những cái mới',
            'Sẵn sàng làm việc OT'
        ];
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

        for ($i = 7; $i <= 7; $i++) {
            DB::table('user')->insert([
                'name' => vnfaker()->fullname(),
                'username' => vnfaker()->username(),
                'phone' => vnfaker()->mobilephone(),
                'role_id' => Constant::ROLE_CANDIDATE,
                'major' => Constant::MAJOR_MANUFACTURING,
                'position' => $position[rand(0,7)],
                'description' => $description[rand(0,7)],
                'email' => vnfaker()->email(),
                'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()
            ]);
        }

        for ($i = 8; $i <= 8; $i++) {
            DB::table('user')->insert([
                'name' => vnfaker()->fullname(),
                'username' => vnfaker()->username(),
                'phone' => vnfaker()->mobilephone(),
                'role_id' => Constant::ROLE_CANDIDATE,
                'major' => Constant::MAJOR_MANUFACTURING,
                'position' => $position[rand(0,7)],
                'description' => $description[rand(0,7)],
                'email' => vnfaker()->email(),
                'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()
            ]);
        }

        for ($i = 9; $i <= 10; $i++) {
            DB::table('user')->insert([
                'name' => vnfaker()->fullname(),
                'username' => vnfaker()->username(),
                'phone' => vnfaker()->mobilephone(),
                'role_id' => Constant::ROLE_CANDIDATE,
                'major' => Constant::MAJOR_IT,
                'position' => $position[rand(0,7)],
                'description' => $description[rand(0,7)],
                'email' => vnfaker()->email(),
                'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()
            ]);
        }

        for ($i = 11; $i <= 12; $i++) {
            DB::table('user')->insert([
                'name' => vnfaker()->fullname(),
                'username' => vnfaker()->username(),
                'phone' => vnfaker()->mobilephone(),
                'role_id' => Constant::ROLE_CANDIDATE,
                'major' => Constant::MAJOR_MARKETING,
                'position' => $position[rand(0,7)],
                'description' => $description[rand(0,7)],
                'email' => vnfaker()->email(),
                'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()
            ]);
        }

        for ($i = 13; $i <= 14; $i++) {
            DB::table('user')->insert([
                'name' => vnfaker()->fullname(),
                'username' => vnfaker()->username(),
                'phone' => vnfaker()->mobilephone(),
                'role_id' => Constant::ROLE_CANDIDATE,
                'major' => Constant::MAJOR_ACCOUNTANT,
                'position' => $position[rand(0,7)],
                'description' => $description[rand(0,7)],
                'email' => vnfaker()->email(),
                'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()
            ]);
        }

        for ($i = 15; $i <= 16; $i++) {
            DB::table('user')->insert([
                'name' => vnfaker()->fullname(),
                'username' => vnfaker()->username(),
                'phone' => vnfaker()->mobilephone(),
                'role_id' => Constant::ROLE_CANDIDATE,
                'major' => Constant::MAJOR_ELECTRONICS,
                'position' => $position[rand(0,7)],
                'description' => $description[rand(0,7)],
                'email' => vnfaker()->email(),
                'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()
            ]);
        }
        for ($i = 17; $i <= 18; $i++) {
            DB::table('user')->insert([
                'name' => vnfaker()->fullname(),
                'username' => vnfaker()->username(),
                'phone' => vnfaker()->mobilephone(),
                'role_id' => Constant::ROLE_CANDIDATE,
                'major' => Constant::MAJOR_REAL_ESTATE,
                'position' => $position[rand(0,7)],
                'description' => $description[rand(0,7)],
                'email' => vnfaker()->email(),
                'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()
            ]);
        }

        for ($i = 19; $i <= 20; $i++) {
            DB::table('user')->insert([
                'name' => vnfaker()->fullname(),
                'username' => vnfaker()->username(),
                'phone' => vnfaker()->mobilephone(),
                'role_id' => Constant::ROLE_CANDIDATE,
                'major' => Constant::MAJOR_CAR_TECHNOLOGY,
                'position' => $position[rand(0,7)],
                'description' => $description[rand(0,7)],
                'email' => vnfaker()->email(),
                'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()
            ]);
        }

        for ($i = 21; $i <= 22; $i++) {
            DB::table('user')->insert([
                'name' => vnfaker()->fullname(),
                'username' => vnfaker()->username(),
                'phone' => vnfaker()->mobilephone(),
                'role_id' => Constant::ROLE_CANDIDATE,
                'major' => Constant::MAJOR_NEWSPAPERS,
                'position' => $position[rand(0,7)],
                'description' => $description[rand(0,7)],
                'email' => vnfaker()->email(),
                'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()
            ]);
        }

        $information = [
            'Chứng chỉ tin học',
            'Chứng chỉ tiếng anh ielts 8.0'
        ];

        DB::table('information')->insert([
            'content' => $information[rand(0,1)],
            'user_id' => rand(7,21),
            'type_id' => 2,
        ]);
    }
}
