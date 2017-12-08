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
            'name' => 'minhquang4334',
            'email' => 'minhquang4334@gmail.com',
            'level' => '1',
            'password' => bcrypt('123456'),
        ]);
        DB::table('admin_users')->insert([
            'name' => 'The Anh',
            'email' => 'hoangtheanhhp@gmail.com',
            'level' => '1',
            'password' => bcrypt('123456'),
        ]);
        DB::table('admin_users')->insert([
            'name' => 'Van Duy',
            'email' => 'vanduy97@gmail.com',
            'level' => '1',
            'password' => bcrypt('123456'),
        ]);
        DB::table('admin_users')->insert([
            'name' => 'Thanh Binh',
            'email' => 'thanhbinh15021997@gmail.com',
            'level' => '1',
            'password' => bcrypt('123456'),
        ]);
    }
}
