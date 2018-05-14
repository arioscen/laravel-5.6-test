<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->delete();

        for ($i=0; $i < 5; $i++) {
            \App\Group::create([
                'title' => 'Title '.$i,
                'description' => 'description '.$i,
                'user_id' => 1,
            ]);
        }
    }
}
