<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account')->insert([
            'loginName'=>'tiendeptrai',
            'password'=> bcrypt('tiendeptrai'),
            'email'=>str_random(5).'@gmail.com'
        ]);
    }
}
