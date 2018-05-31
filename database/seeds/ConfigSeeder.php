<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->delete();
        \App\Config::create([
            'name' => 'active',
            'value' => '0',
        ]);
    }
}
