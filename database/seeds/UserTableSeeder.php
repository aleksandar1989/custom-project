<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_guest  = Role::where('name', 'guest')->first();

        $employee = new User();
        $employee->name = 'Aleksandar Markovic';
        $employee->email = 'aleksandar.markovic@smartweb.rs';
        $employee->password = bcrypt('idemo123');
        $employee->save();
        $employee->roles()->attach($role_admin);

        $employee = new User();
        $employee->name = 'Aleksandar Radojicic';
        $employee->email = 'aleksandar.radojicic@smartweb.rs';
        $employee->password = bcrypt('idemo123');
        $employee->save();
        $employee->roles()->attach($role_guest);
    }
}
