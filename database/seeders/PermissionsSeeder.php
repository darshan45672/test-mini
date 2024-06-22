<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list activities']);
        Permission::create(['name' => 'view activities']);
        Permission::create(['name' => 'create activities']);
        Permission::create(['name' => 'update activities']);
        Permission::create(['name' => 'delete activities']);

        Permission::create(['name' => 'list activitytypes']);
        Permission::create(['name' => 'view activitytypes']);
        Permission::create(['name' => 'create activitytypes']);
        Permission::create(['name' => 'update activitytypes']);
        Permission::create(['name' => 'delete activitytypes']);

        Permission::create(['name' => 'list colleges']);
        Permission::create(['name' => 'view colleges']);
        Permission::create(['name' => 'create colleges']);
        Permission::create(['name' => 'update colleges']);
        Permission::create(['name' => 'delete colleges']);

        Permission::create(['name' => 'list departments']);
        Permission::create(['name' => 'view departments']);
        Permission::create(['name' => 'create departments']);
        Permission::create(['name' => 'update departments']);
        Permission::create(['name' => 'delete departments']);

        Permission::create(['name' => 'list faculties']);
        Permission::create(['name' => 'view faculties']);
        Permission::create(['name' => 'create faculties']);
        Permission::create(['name' => 'update faculties']);
        Permission::create(['name' => 'delete faculties']);

        Permission::create(['name' => 'list hods']);
        Permission::create(['name' => 'view hods']);
        Permission::create(['name' => 'create hods']);
        Permission::create(['name' => 'update hods']);
        Permission::create(['name' => 'delete hods']);

        Permission::create(['name' => 'list students']);
        Permission::create(['name' => 'view students']);
        Permission::create(['name' => 'create students']);
        Permission::create(['name' => 'update students']);
        Permission::create(['name' => 'delete students']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
