<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ShowTag;
use App\Models\Show;
use App\Models\Tag;


class ShowTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Empty the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('show_tag')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        //Define data
        $showTags = [
            [
                'show_slug'=>'ayiti',
                'tag'=>'horreur',
            ],
            [
                'show_slug'=>'ayiti',
                'tag'=>'humour',
            ],
            [
            'show_slug'=>'ayiti',
            'tag'=>'belge',
            ],
            /////
            [
                'show_slug'=>'cible-mouvante',
                'tag'=>'nominé',
                ],
                [
                    'show_slug'=>'cible-mouvante',
                    'tag'=>'comédie',
                    ],                
                    [
                        'show_slug'=>'cible-mouvante',
                        'tag'=>'international',
                        ],

                        [
                            'show_slug'=>'manneke',
                            'tag'=>'belge',
                            ],
                            [
                                'show_slug'=>'manneke',
                                'tag'=>'comédie',
                                ],                
                                [
                                    'show_slug'=>'manneke',
                                    'tag'=>'horreur',
                                    ],         
        ];
        
        foreach ($showTags as &$data) {
            $show = Show::where([
                ['slug','=',$data['show_slug'] ],
            ])->first();

            $tag = Tag::firstWhere('tag',$data['tag']);
            
            unset($data['show_slug']);
            unset($data['tag']);

            $data['show_id'] = $show->id;
            $data['tag_id'] = $tag->id;
        }
        unset($data);

        //Insert data in the table
        DB::table('show_tag')->insert($showTags);
    }    
}

