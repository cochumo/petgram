<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['イヌ', 'ネコ', '鳥', 'ハムスター', '魚', 'うさぎ', 'カメ', 'カワウソ', 'かっこいい', 'かわいい', 'おもしろい', 'おどろき', 'もっと見たい'];
        foreach ($tags as $tag) Tag::create(['name' => $tag, 'original_flag' => 1]);
    }
}
