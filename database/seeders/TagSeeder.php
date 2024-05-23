<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;


class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Tag::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        
        //Define data
       $tags = [
            ['tag'=>'horreur'],
            ['tag'=>'humour'],
            ['tag'=>'belge'],
            ['tag'=>'nominé'],
            ['tag'=>'comédie'],
            ['tag'=>'international'],
        ];
        
        //Insert data in the table
        DB::table('tags')->insert($tags);

    }
}