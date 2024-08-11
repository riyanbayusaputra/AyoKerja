<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'manage categories',
            'manage company',
            'manage jobs',
            'manage applicants',
            'apply job',
        ];

        // Create or find permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        // Create or find roles and assign permissions
        $employerRole = Role::firstOrCreate(['name' => 'employer']);
        $employerPermissions = ['manage company', 'manage jobs', 'manage applicants'];
        $employerRole->syncPermissions($employerPermissions);

        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $employeePermissions = ['apply job'];
        $employeeRole->syncPermissions($employeePermissions);

        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $employerPermissions = ['manage company', 'manage jobs', 'manage applicants','apply job','manage categories'];

        // Create a super admin user and assign the super admin role
        $user = User::firstOrCreate([
            'email' => 'super@admin.com'
        ], [
            'name' => 'Super Admin',
            'occupation' => 'Superadmin',
            'experience' => 100,
            'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('1234567890')
        ]);

        $user->assignRole($superAdminRole);
    }
}
