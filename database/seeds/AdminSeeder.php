<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        factory('App\Admin',3)->create([
            'password' => bcrypt('123456')
            ]);
    }
}
