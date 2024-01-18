<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this->createPermissions();
        $this->createRoles();
    }

    //// --------------- Permissions Section

    /**
     * Retorna los modelos que posee el sistema.
     * 
     * Sale = Order / OrderDetails
     * Purchase = PurchaseOrder / PurchaseDetails
     * 
     * @return array
     */
    private function getAllModels(): array
    {
        return ['category', 'customer', 'employee', 'expense', 'pos', 'ppos', 'sale', 'purchase', 'assistance', 'paysalary', 'product', 'supplier'];
    }

    private function createPermissions()
    {
        /// Nav menu
        foreach ($this->getAllModels() as $menu) {
            $permissionPath = "can_{$menu}";
            Permission::create(['name' => $permissionPath]);
        }
    }

    //// --------------- Roles Section
    private function permissionsPerRole()
    {
        // El Admin tendra acceso total
        return [
            'caja' => [
                'pos', 'ppos'
            ],
            'encargado' => [
                'sale', 'purchase', 'expense', 'customer', 'supplier', 'assistance', 'product'
            ],
            'gerente' => $this->getAllModels()
        ];
    }

    private function createRoles()
    {
        foreach ($this->permissionsPerRole() as $role => $modelsAvailable) {
            $role = Role::create(['name' => $role]);

            foreach ($modelsAvailable as $model) {
                $permission = Permission::findByName("can_{$model}");
                $role->givePermissionTo($permission);
            }
        }
    }
}
