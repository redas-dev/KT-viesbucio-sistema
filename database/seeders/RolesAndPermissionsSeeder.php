<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Seed the application with default roles and permissions.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view rooms',
            'create rooms',
            'edit rooms',
            'delete rooms',

            'view reservations',
            'create reservations',
            'edit reservations',
            'delete reservations',

            'view ratings',
            'create ratings',

            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions([
            'view rooms',
            'create rooms',
            'edit rooms',
            'delete rooms',

            'view reservations',
            'edit reservations',
            'delete reservations',
        ]);

        $directorRole = Role::firstOrCreate(['name' => 'director']);
        $directorRole->syncPermissions([
           'view dashboard',
           'view ratings'
        ]);

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions([
            'view rooms',
            'create reservations',
            'view ratings',
            'create ratings',
        ]);
    }
}
