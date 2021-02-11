<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon as Time;

class dummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $now = Time::now();
        DB::table('users')->insert([
            'name' => 'root',
            'email' => 'root@mail.com',
            'password' => 'root',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => 'john doe_' . Str::random(2),
                'email' => Str::random(5) . '@mail.com',
                'password' => 'pass',
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }
    }
}
