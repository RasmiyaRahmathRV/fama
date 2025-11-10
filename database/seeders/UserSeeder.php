<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Super Admin', 'Admin', 'Sales', 'Accountant', 'Manager', 'Operations', 'Data Analyst'] as $role) {
            UserType::create([
                'user_type' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $modules = [
            'area',
            'locality',
            'property_type',
            'property',
            'vendor',
            'bank',
            'installments',
            'payment_mode',
            'nationality',
            'company',
            'user',
            'contract',
            'agreement',
            'investor',
            'investment',
            'finance',
            'report'
        ];

        foreach ($modules as $module) {
            $parent = Permission::create([
                'permission_name' => ucfirst($module),
                'parent_id' => null
            ]);

            if ($module == 'finance') {
                $subModule = ['payout', 'cheque_clearing'];
            } elseif ($module == 'report') {
                $subModule = ['view'];
            } else {
                $subModule = ['add', 'view', 'edit', 'delete'];
                if (in_array($module, ['contract', 'agreement'])) {
                    $subModule[] = 'approve';
                    $subModule[] = 'reject';
                    $subModule[] = 'document_upload';
                    $subModule[] = 'renew';
                }
            }

            foreach ($subModule as $action) {
                Permission::create([
                    'permission_name' => "{$module}.{$action}",
                    'parent_id' => $parent->id
                ]);
            }
        }

        $user_id = User::create([
            'user_code' => 'USR0001',
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'user_type_id' => 1,
            'email' => 'superadmin@demo.com',
            'username' => 'superadmin',
            'password' => bcrypt('captain'),
            'added_by' => 1,
        ])->id;

        foreach (Permission::all() as $permissions) {
            UserPermission::create([
                'user_id' => $user_id,
                'permission_id' => $permissions->id,
            ]);
        }
    }
}
