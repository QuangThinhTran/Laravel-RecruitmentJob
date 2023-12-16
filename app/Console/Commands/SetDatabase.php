<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Artisan::call('db:seed --class=TicketTypeTableSeeder');
        Artisan::call('db:seed --class=RoleTableSeeder');
        Artisan::call('db:seed --class=InformationTypeTableSeeder');
        Artisan::call('db:seed --class=AdminTableSeeder');
        Artisan::call('db:seed --class=CompanyTableSeeder');
        Artisan::call('db:seed --class=UserTableSeeder');
        Artisan::call('db:seed --class=PostTableSeeder');
        Artisan::call('db:seed --class=TicketTableSeeder');
        Artisan::call('db:seed --class=AppliedTableSeeder');
    }
}
