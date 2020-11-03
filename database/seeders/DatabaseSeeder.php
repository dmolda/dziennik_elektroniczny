<?php

namespace Database\Seeders;

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

         $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(ClassesTableSeeder::class);
         $this->call(StudentsTableSeeder::class);
         $this->call(TeachersTableSeeder::class);
         $this->call(SubjectsTableSeeder::class);
    }
}
