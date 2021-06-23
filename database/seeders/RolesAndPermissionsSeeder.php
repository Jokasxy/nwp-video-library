<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'modify']);
        Permission::create(['name' => 'borrow']);

        Role::create(['name' => 'admin'])->givePermissionTo(['modify']);
        Role::create(['name' => 'user'])->givePermissionTo(['borrow']);

    }
}
