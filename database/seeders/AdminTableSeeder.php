<?php

namespace Database\Seeders;

use App\Constant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Buihuycuong\Vnfaker\VNFaker;

class AdminTableSeeder extends Seeder
{
    use WithFaker;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $street = ['Hoàng Hoa Thám', 'Nguyễn Lý', 'Nguyễn Thị Minh Khai', 'An Dương Vương', 'Nguyễn Thị Thập', 'Hai Bà Trưng'];
        $district = ['quận 1', 'quận 7', 'quận Thủ Đức', 'quận Bình Thạnh', 'quận Gò Vấp', 'quận Phú Nhuận'];

        DB::table('user')->insert([
            'name' => 'FindingJob',
            'username' => 'admin',
            'phone' => vnfaker()->mobilephone(),
            'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
            'role_id' => Constant::ROLE_ADMIN,
            'major' => Constant::MAJOR_IT,
            'position' => 'Giám đốc',
            'email' => 'thinhminhlove@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now()
        ]);

        DB::table('information')->insert([
            'content' => vnfaker()->sentences(),
            'user_id' => 1,
            'type_id' => rand(1,5),
        ]);
    }
}
