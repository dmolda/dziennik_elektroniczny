<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pl_PL');

        $user = new User();
        $user->name = $faker->name;
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('qwerty12');
        $user->save();
        $user->roles()->attach(Roles::where('name','administrator')->first()->id);

        $user = new User();
        $user->name = $faker->name;
        $user->email = 'uczen@uczen.com';
        $user->password = bcrypt('qwerty12');
        $user->save();
        $user->roles()->attach(Roles::where('name','uczen')->first()->id);

        $user = new User();
        $user->name = $faker->name;
        $user->email = 'nauczyciel@nauczyciel.com';
        $user->password = bcrypt('qwerty12');
        $user->save();
        $user->roles()->attach(Roles::where('name','nauczyciel')->first()->id);

        $user = new User();
        $user->name = $faker->name;
        $user->email = 'rodzic@rodzic.com';
        $user->password = bcrypt('qwerty12');
        $user->save();
        $user->roles()->attach(Roles::where('name','rodzic')->first()->id);

        for($i=0;$i<25;$i++){
            $user = new User();
            $user->name = $faker->userName;
            $user->email = $faker->email;
            $user->password = bcrypt('qwerty12');
            $user->save();
            $user->roles()->attach(Roles::where('name','uczen')->first()->id);

        }

        for($i=0;$i<15;$i++){
            $user = new User();
            $user->name = $faker->userName;
            $user->email = $faker->email;
            $user->password = bcrypt('qwerty12');
            $user->save();
            $user->roles()->attach(Roles::where('name','nauczyciel')->first()->id);

        }


        for($i=0;$i<10;$i++){
            $user = new User();
            $user->name = $faker->userName;
            $user->email = $faker->email;
            $user->password = bcrypt('qwerty12');
            $user->save();

        }
    }
}
