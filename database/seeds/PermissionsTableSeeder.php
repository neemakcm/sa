<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['id' => 1,
            'title' => 'Roles',
            'slug' => 'roles',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['id' => 2,
            'title' => 'Admin Users',
            'slug' => 'admin_users',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
            
        ]);

        DB::table('role_permission')->insert([
            ['role_id' => 1,
            'permission_id' => 1],
            ['role_id' => 1,
            'permission_id' => 2]
        ]);
    }
}
