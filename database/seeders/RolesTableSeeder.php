<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Roles();
        $role->name = 'Administrator';
        $role->save();

        $role = new Roles();
        $role->name = 'Sekretariat';
        $role->save();

        $role = new Roles();
        $role->name = 'Wychowawca';
        $role->save();

        $role = new Roles();
        $role->name = 'Nauczyciel';
        $role->save();

        $role = new Roles();
        $role->name = 'Rodzic';
        $role->save();

        $role = new Roles();
        $role->name = 'Uczen';
        $role->save();

        $role = new Roles();
        $role->name = 'Nowy';
        $role->save();


    }
}
