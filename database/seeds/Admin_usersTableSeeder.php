<?php

use Illuminate\Database\Seeder;

class Admin_usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            'name' => 'P712plus',
            'email' => 'minhquang4334@gmail.com',
            'level' => '1',
            'password' => bcrypt('123456'),
        ]);
    }
}
