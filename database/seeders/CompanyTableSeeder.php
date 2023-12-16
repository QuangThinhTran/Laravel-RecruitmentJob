<?php

namespace Database\Seeders;

use App\Constant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Buihuycuong\Vnfaker\VNFaker;
class CompanyTableSeeder extends Seeder
{
    use WithFaker;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $description = 'Khởi nghiệp với một thôi thúc mạnh mẽ xây dựng nước nhà thịnh vượng hơn và kiến tạo một xã hội tốt đẹp hơn.
        Nâng tầm giá trị Việt. Luôn đặt ra những mục tiêu thách thức & thực hiện bằng quyết tâm mạnh mẽ nhất.
        Cầu thị để học hỏi, để tiến bộ không ngừng, sẵn sàng đón nhận nhiệm vụ mới. Đổi mới trong cách làm và tư duy tạo ra hiệu quả cao nhất.
        Tận tụy & tâm huyết, có trách nhiệm nỗ lực tối đa để đạt kết quả tốt nhất';

        $street = ['Hoàng Hoa Thám', 'Nguyễn Lý', 'Nguyễn Thị Minh Khai', 'An Dương Vương', 'Nguyễn Thị Thập', 'Hai Bà Trưng'];
        $district = ['quận 1', 'quận 7', 'quận Thủ Đức', 'quận Bình Thạnh', 'quận Gò Vấp', 'quận Phú Nhuận'];

        for ($i = 2; $i <= 5; $i++) {
            DB::table('user')->insert([
                'name' => vnfaker()->company(),
                'username' => vnfaker()->username(),
                'phone' => vnfaker()->mobilephone(),
                'major' => Constant::MAJOR_MARKETING,
                'position' => 'Trưởng phòng',
                'role_id' => Constant::ROLE_COMPANY,
                'email' => vnfaker()->email(),
                'img_avatar' => 'company' . rand(1,10) . '.jpg',
                'address' => rand(50, 300) . ' ' . $street[rand(0,5)] . ', ' . $district[rand(0,5)] . ', TP Hồ Chí Minh',
                'description' => $description,
                'password' => Hash::make('12345678'),
                'created_at' => Carbon::now()
            ]);

            DB::table('information')->insert([
                'content' => vnfaker()->sentences(),
                'user_id' => $i,
                'type_id' => rand(1,5),
            ]);

            DB::table('company_information')->insert([
                'staff' => fake()->numerify,
                'headquarters' => vnfaker()->city(),
                'taxcode' => fake()->unique()->numerify(),
                'website' => 'https://' . fake()->domainName,
                'user_id' => $i
            ]);
        }
    }
}
