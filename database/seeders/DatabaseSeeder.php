<?php
namespace Database\Seeders;

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
        $this->call([
            //ArtistSeeder::class,
            //UserSeeder::class,
            //LocalitySeeder::class,
            //RoleSeeder::class,
            //TypeSeeder::class,
            //LocationSeeder::class,
            //ShowSeeder::class,
            //RepresentationSeeder::class,
            //ArtistTypeSeeder::class,
            //ArtistTypeShowSeeder::class,
            //UserRoleSeeder::class,
            //UserRepresentationSeeder::class,
            //TagSeeder::class,
            ShowTagSeeder::class,
        ]);
    }
}

