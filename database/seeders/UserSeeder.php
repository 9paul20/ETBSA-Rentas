<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Roles De Usuario
        $RAdmin = Role::create(['name' => 'Admin', 'display_name' => 'Administrador', 'description' => 'Este rol tiene acceso completo al sistema y puede realizar cualquier tarea, incluyendo la creación, actualización y eliminación de usuarios, roles y permisos. También puede ver y actualizar la información del sitio web.']);
        $RSeller = Role::create(['name' => 'Seller', 'display_name' => 'Vendedor', 'description' => 'Este rol es para los usuarios que venden productos o servicios en el sitio web. Este rol tiene acceso limitado al sistema y solo puede realizar acciones relacionadas con su propia cuenta y sus productos o servicios, como agregar o eliminar productos, actualizar su información de perfil, ver pedidos de sus productos, etc.']);
        $RClient = Role::create(['name' => 'Client', 'display_name' => 'Cliente', 'description' => 'Este rol es para los usuarios que utilizan el sitio web para realizar compras o transacciones. Este rol tiene acceso limitado al sistema y solo puede realizar acciones relacionadas con su propia cuenta, como ver su historial de compras, actualizar su información personal, etc.']);

        //Permisos De Usuario

        //Permisos para CRUD Usuario
        $VUpermission = Permission::create(['name' => 'View Users', 'display_name' => 'Ver Usuarios', 'description' => 'Este permiso permite al usuario ver la lista completa de usuarios registrados en el sistema.'])->syncRoles([$RAdmin, $RSeller]);
        $CUpermission = Permission::create(['name' => 'Create Users', 'display_name' => 'Crear Usuarios', 'description' => 'Este permiso permite al usuario crear nuevos usuarios en el sistema.'])->syncRoles([$RAdmin]);
        $UUpermission = Permission::create(['name' => 'Update Users', 'display_name' => 'Actualizar Usuarios', 'description' => 'Este permiso permite al usuario actualizar la información de cualquier usuario registrado en el sistema.'])->syncRoles([$RAdmin]);
        $DUpermission = Permission::create(['name' => 'Delete Users', 'display_name' => 'Eliminar Usuarios', 'description' => 'Este permiso permite al usuario eliminar cualquier usuario registrado en el sistema.'])->syncRoles([$RAdmin]);

        //Permisos para CRUD Permisos
        $VPpermission = Permission::create(['name' => 'View Permissions', 'display_name' => 'Ver Permisos', 'description' => 'Este permiso permite al usuario ver la lista completa de permisos registrados en el sistema.'])->syncRoles([$RAdmin, $RSeller]);
        $CPpermission = Permission::create(['name' => 'Create Permissions', 'display_name' => 'Crear Permisos', 'description' => 'Este permiso permite al usuario crear nuevos permisos en el sistema.'])->syncRoles([$RAdmin]);
        $UPpermission = Permission::create(['name' => 'Update Permissions', 'display_name' => 'Actualizar Permisos', 'description' => 'Este permiso permite al usuario actualizar la información de cualquier permiso registrado en el sistema.'])->syncRoles([$RAdmin]);
        $DPpermission = Permission::create(['name' => 'Delete Permissions', 'display_name' => 'Eliminar Permisos', 'description' => 'Este permiso permite al usuario eliminar cualquier permiso registrado en el sistema.'])->syncRoles([$RAdmin]);

        //Permisos para CRUD Roles
        $VRpermission = Permission::create(['name' => 'View Roles', 'display_name' => 'Ver Roles', 'description' => 'Este permiso permite al usuario ver la lista completa de roles registrados en el sistema.'])->syncRoles([$RAdmin, $RSeller]);
        $CRpermission = Permission::create(['name' => 'Create Roles', 'display_name' => 'Crear Roles', 'description' => 'Este permiso permite al usuario crear nuevos roles en el sistema.'])->syncRoles([$RAdmin]);
        $URpermission = Permission::create(['name' => 'Update Roles', 'display_name' => 'Actualizar Roles', 'description' => 'Este permiso permite al usuario actualizar la información de cualquier rol registrado en el sistema.'])->syncRoles([$RAdmin]);
        $DRpermission = Permission::create(['name' => 'Delete Roles', 'display_name' => 'Eliminar Roles', 'description' => 'Este permiso permite al usuario eliminar cualquier rol registrado en el sistema.'])->syncRoles([$RAdmin]);

        // create admin account
        $AdminUser = User::create([
            'name' => 'John Doe',
            'email' => 'admin@gmail.com',
            'password' => '1234567',
            'remember_token' => Str::random(10),
            'last_login' => Carbon::now(),
            'active' => Carbon::now(),
            'activation_key' => Uuid::uuid4()->toString(),
            'email_verified_at' => Carbon::now(),
        ])->assignRole('Admin');
        $AdminUser->clvPersona = $AdminUser->id;
        $AdminUser->save();

        $AdminETBSA = User::create([
            'name' => 'Admin Uno ETBSA',
            'email' => 'admin_uno@etbsa.com.mx',
            'password' => '123456',
            'remember_token' => Str::random(10),
            'last_login' => Carbon::now(),
            'active' => Carbon::now(),
            'activation_key' => Uuid::uuid4()->toString(),
            'email_verified_at' => Carbon::now(),
        ])->assignRole('Admin');
        $AdminETBSA->clvPersona = $AdminETBSA->id;
        $AdminETBSA->save();

        //Cuenta de Vendedor
        $VendedorETBSA = User::create([
            'name' => 'Vendedor Uno ETBSA',
            'email' => 'seller_uno@etbsa.com.mx',
            'password' => '12345678',
            'remember_token' => Str::random(10),
            'last_login' => Carbon::now(),
            'active' => Carbon::now(),
            'activation_key' => Uuid::uuid4()->toString(),
            'email_verified_at' => Carbon::now(),
        ])->assignRole('Seller');
        $VendedorETBSA->clvPersona = $VendedorETBSA->id;
        $VendedorETBSA->save();

        //Cuenta de Cliente
        $ClienteETBSA = User::create([
            'name' => 'Cliente Uno ETBSA',
            'email' => 'client_uno@etbsa.com.mx',
            'password' => '123456789',
            'remember_token' => Str::random(10),
            'last_login' => Carbon::now(),
            'active' => Carbon::now(),
            'activation_key' => Uuid::uuid4()->toString(),
            'email_verified_at' => Carbon::now(),
        ])->assignRole('Client');
        $ClienteETBSA->clvPersona = $ClienteETBSA->id;
        $ClienteETBSA->save();

        //TODO. generate random users -> Origina SourceCode

        //* generate random users -> Modified And Functional
        User::factory()
            ->count(50)
            ->create()
            ->each(function ($user) {
                $password = Str::random(12); // Generar una cadena aleatoria de 12 caracteres
                $user->password = substr($password, 0, rand(6, 12)); // Limitar la longitud de la cadena aleatoria entre 6 y 12 caracteres
                $user->save();
                $user->clvPersona = $user->id;
                $user->save();
                $user->roles()->attach(Role::where('name', 'Client')->first());
            });
    }
}