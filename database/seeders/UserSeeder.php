<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use \Carbon\Carbon as Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Models\User');
        for($i=1;$i<=100;$i++){
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt($faker->password),
                'address' => $faker->address,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
