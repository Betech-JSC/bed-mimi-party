<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('permissions')) {
            return;
        }

        $permissions = [
            'admin.partners.index',
            'admin.partners.form',
            'admin.partners.store',
            'admin.partners.destroy',
            'admin.partners.restore',
            'admin.projects.index',
            'admin.projects.form',
            'admin.projects.store',
            'admin.projects.destroy',
            'admin.projects.restore',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin',
            ]);
        }

        $superAdmin = Role::where('name', 'Super Admin')->where('guard_name', 'admin')->first();
        if ($superAdmin) {
            $superAdmin->givePermissionTo($permissions);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Safe migration: do not drop data on rollback
    }
};
