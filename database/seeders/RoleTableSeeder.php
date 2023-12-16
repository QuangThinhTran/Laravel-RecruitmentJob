<?php

namespace Database\Seeders;

use App\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    use WithFaker;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            switch ($i)
            {
                case Constant::ROLE_ADMIN:
                    DB::table('role')->insert([
                        'content' => 'admin',
                    ]);
                    break;
                case Constant::ROLE_COMPANY:
                    DB::table('role')->insert([
                        'content' => 'company',
                    ]);
                    break;
                case Constant::ROLE_CANDIDATE:
                    DB::table('role')->insert([
                        'content' => 'candidate',
                    ]);
            }
        }
    }
}
