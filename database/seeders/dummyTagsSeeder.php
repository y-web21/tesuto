<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dummyTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['戯言','無価値','風説の流布'];
        foreach ($tags as $tag) {
            DB::table('tags')->insert(['name' => $tag]);
        }
    }
}
