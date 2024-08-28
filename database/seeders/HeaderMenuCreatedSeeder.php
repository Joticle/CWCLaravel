<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeaderMenuCreatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminMenu = DB::table('admin_menus')->first();
        if ($adminMenu == null) {
            DB::table('admin_menus')->insert([
                'name' => 'Home',
                'created_at' => now(),
            ]);
        }
    }
}
