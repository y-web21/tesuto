<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article_statuses = [0 => '非公開', '公開', '有料公開', '検閲待ち', '執筆中'];
        foreach($article_statuses as $key => $status){
            DB::table('article_statuses')->insert(['status_id' => $key ,'status_name' => $status]);
        }
    }
}
