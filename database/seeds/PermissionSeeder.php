<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        DB::table('roles')->delete();
        
        Role::create(['name' => 'admin']);

        $role = Role::create(['name' => 'normal']);
        $permission = Permission::create(['name' => 'edit posts']);

        $role->givePermissionTo($permission);
    }
}
