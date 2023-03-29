<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol1 = Role::create(['name' => 'Admin']);
        $rol2 = Role::create(['name' => 'Student']);
        $rol3 = Role::create(['name' => 'Teacher']);

        Permission::create(['name' => 'admin.alumnos'])->syncRoles([$rol1, $rol2]);

        Permission::create(['name' => 'admin.alumno.lista'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'admin.alumno.ver'])->syncRoles([$rol1, $rol2, $rol3]);
        Permission::create(['name' => 'admin.alumno.guardar'])->syncRoles([$rol1]);
        Permission::create(['name' => 'admin.alumno.borrar'])->syncRoles([$rol1]);

        Permission::create(['name' => 'admin.profesor.lista'])->syncRoles([$rol1]);
        Permission::create(['name' => 'admin.profesor.ver'])->syncRoles([$rol1]);
        Permission::create(['name' => 'admin.profesor.guardar'])->syncRoles([$rol1]);
        Permission::create(['name' => 'admin.profesor.borrar'])->syncRoles([$rol1]);

        Permission::create(['name' => 'admin.materia.lista'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'admin.materia.ver'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'admin.materia.guardar'])->syncRoles([$rol1]);
        Permission::create(['name' => 'admin.materia.borrar'])->syncRoles([$rol1]);
        Permission::create(['name' => 'admin.materia.combo'])->syncRoles([$rol1, $rol2]);

        Permission::create(['name' => 'admin.grupo.lista'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'admin.grupo.ver'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'admin.grupo.guardar'])->syncRoles([$rol1]);
        Permission::create(['name' => 'admin.grupo.borrar'])->syncRoles([$rol1]);

        Permission::create(['name' => 'admin.plista.lista'])->syncRoles([$rol1, $rol2, $rol3]);
        Permission::create(['name' => 'admin.plista.ver'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'admin.plista.guardar'])->syncRoles([$rol1]);
        Permission::create(['name' => 'admin.plista.borrar'])->syncRoles([$rol1]);
        
        Permission::create(['name' => 'admin.rol.combo'])->syncRoles([$rol1]);

        //$role1->permissions()->attach(1,2,3);

    }
}
