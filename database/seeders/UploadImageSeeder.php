<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Time;

class UploadImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            ['public/images/', 'dummy.jpg', 'ひげ000'],
            ['public/images/', 'default-001.jpg', 'ひげ001'],
            ['public/images/', 'default-002.jpg', 'ひげ002'],
            ['public/images/', 'default-003.jpg', 'ひげ003'],
            ['public/images/', 'default-004.jpg', 'ひげ004'],
            ['public/images/', 'default-005.jpg', 'ひげ005'],
            ['public/images/', 'default-006.jpg', 'ひげ006'],
            ['public/images/', 'default-007.jpg', 'ひげ007'],
            ['public/images/', 'default-008.jpg', 'ひげ008'],
            ['public/images/', 'default-009.jpg', 'ひげ009'],
            ['public/images/', 'default-010.jpg', 'ひげ010'],
            ['public/images/', 'default-011.jpg', 'ひげ011'],
            ['public/images/', 'default-012.jpg', 'ひげ012'],
            ['public/images/', 'default-013.jpg', 'ひげ013'],
            ['public/images/', 'default-014.jpg', 'ひげ014'],
            ['public/images/', 'default-015.jpg', 'ひげ015'],
            ['public/images/', 'default-016.jpg', 'ひげ016'],
            ['public/images/', 'default-017.jpg', 'ひげ017'],
            ['public/images/', 'default-018.jpg', 'ひげ018'],
            ['public/images/', 'default-019.jpg', 'ひげ019'],
            ['public/images/', 'default-020.jpg', 'ひげ020'],
            ['public/images/', 'default-021.jpg', 'ひげ021'],
            ['public/images/', 'default-022.jpg', 'ひげ022'],
            ['public/images/', 'default-023.jpg', 'ひげ023'],
            ['public/images/', 'default-024.jpg', 'ひげ024'],
            ['public/images/', 'default-025.jpg', 'ひげ025'],
            ['public/images/', 'default-026.jpg', 'ひげ026'],
            ['public/images/', 'default-027.jpg', 'ひげ027'],
            ['public/images/', 'default-028.jpg', 'ひげ028'],
            ['public/images/', 'default-029.jpg', 'ひげ029'],
            ['public/images/', 'default-030.jpg', 'ひげ030'],
            ['public/images/', 'default-031.jpg', 'ひげ031'],
            ['public/images/', 'default-032.jpg', 'ひげ032'],
            ['public/images/', 'default-033.jpg', 'ひげ033'],
            ['public/images/', 'default-034.jpg', 'ひげ034'],
            ['public/images/', 'default-035.jpg', 'ひげ035'],
            ['public/images/', 'default-036.jpg', 'ひげ036'],
            ['public/images/', 'default-037.jpg', 'ひげ037'],
            ['public/images/', 'default-038.jpg', 'ひげ038'],
            ['public/images/', 'default-039.jpg', 'ひげ039'],
            ['public/images/', 'default-040.jpg', 'ひげ040'],
            ['public/images/', 'default-041.jpg', 'ひげ041'],
            ['public/images/', 'default-042.jpg', 'ひげ042'],
            ['public/images/', 'default-043.jpg', 'ひげ043'],
            ['public/images/', 'default-044.jpg', 'ひげ044'],
            ['public/images/', 'default-045.jpg', 'ひげ045'],
            ['public/images/', 'default-046.jpg', 'ひげ046'],
        ];
        $now = Time::now();
        foreach ($images as $line) {
            DB::table('upload_images')->insert([
                'path' => $line[0] . $line[1],
                'name' => $line[1],
                'user_id' => random_int(1,9),
                'description' => $line[2],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
