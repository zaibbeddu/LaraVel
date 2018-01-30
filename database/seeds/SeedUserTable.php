<?php

use Illuminate\Database\Seeder;
use App\User;

class SeedUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        factory(App\User::class, 30)->create();
        //

      /*  $sql = 'INSERT INTO users (name,email,password,created_at)
                values(:name,:email,:password,:created_at)';
      for ($i=0;$i<31;$i++){
        DB::statement($sql, [
                'name' => 'Gianni'.$i,
                'email' => 'tag'.$i.'@gmail.com',
                'password' => bcrypt('password'),
                'created_at' => now()
            ]);
      }*/

    }
}
