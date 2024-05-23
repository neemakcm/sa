<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@webcastle.in',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
