<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'admin';
        $role_employee->description = 'Admin has a full access to the site and admin panel';
        $role_employee->save();

        $role_manager = new Role();
        $role_manager->name = 'manager';
        $role_manager->description = 'A Manager User';
        $role_manager->save();

        $role_employee = new Role();
        $role_employee->name = 'employee';
        $role_employee->description = 'A Employee User';
        $role_employee->save();

        $role_employee = new Role();
        $role_employee->name = 'guest';
        $role_employee->description = 'Guest can see site, but can\'t access to the admin panel';
        $role_employee->save();


    }
}
