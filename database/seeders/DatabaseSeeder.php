<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        Article::create([
            'name' => '文章6',
            'content' => '林志傑是SBL第一屆（2003－2004）及第二屆（2004－2005）的「得分王」，是2013年亞洲籃球錦標賽中華台北男子籃球代表隊的隊長。2013年亞洲籃球錦標賽分組賽對上菲律賓，取得20分、12助攻、9籃板的準大三元成績，是中華隊逆轉菲律賓的重要功臣。2013年亞洲籃球錦標賽半準決賽對上中國隊關鍵一役，取得17分2籃板7助攻的精彩表現，幫助中華隊進入四強賽，寫下台灣籃壇歷史上重要一頁。',
            'user_id' => '1'
        ]);
    }
}
