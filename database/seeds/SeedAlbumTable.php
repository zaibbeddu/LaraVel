<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use App\Models\Album;

class SeedAlbumTable extends Seeder
{
 
    public function run()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Album::truncate();
        factory(App\Models\Album::class, 10)->create();
        //
        
    }
}