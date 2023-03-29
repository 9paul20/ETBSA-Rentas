<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionSuperUser = Permission::create([
            'title' => 'Super User',
            'description' => 'Superuser permission',
            'key' => Permission::SUPER_USER_PERMISSION_KEY,
        ]);

        // create all other permissions
        $permissionSample1 = Permission::create([
            'title' => 'User Create',
            'description' => 'Permission to create user. This is an example permission only',
            'key' => 'user.create',
        ]);
        $permissionSample2 = Permission::create([
            'title' => 'User Edit',
            'description' => 'Permission to edit user. This is an example permission only',
            'key' => 'user.edit',
        ]);
        $permissionSample3 = Permission::create([
            'title' => 'User Delete',
            'description' => 'Permission to delete user. This is an example permission only',
            'key' => 'user.delete',
        ]);

        // create super user group
        $groupSuperUser = Group::create([
            'name' => Group::SUPER_USER_GROUP_NAME,
            'permissions' => [
                [
                    'title' => 'Super User',
                    'description' => 'Superuser permission',
                    'key' => Permission::SUPER_USER_PERMISSION_KEY,
                    'value' => 1
                ]
            ]
        ]);
        $groupSuperUser->addPermission($permissionSuperUser, Permission::PERMISSION_ALLOW);

        // create normal user
        $groupDefaultUser = Group::create([
            'name' => Group::DEFAULT_USER_GROUP_NAME,
            'permissions' => []
        ]);

        // create admin account
        $AdminUser = User::create([
            'name' => 'John Doe',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'remember_token' => Str::random(10),
            'permissions' => [],
            'last_login' => Carbon::now(),
            'active' => Carbon::now(),
            'activation_key' => Uuid::uuid4()->toString(),
            'email_verified_at' => Carbon::now(),
        ]);
        $AdminUser->clvPersona = $AdminUser->id;
        $AdminUser->save();

        // make super user
        $AdminUser->groups()->attach($groupSuperUser);

        $AdminETBSA = User::create([
            'name' => 'Admin ETBSA',
            'email' => 'admin@etbsa.com.mx',
            'password' => '123456',
            'remember_token' => Str::random(10),
            'permissions' => [],
            'last_login' => Carbon::now(),
            'active' => Carbon::now(),
            'activation_key' => Uuid::uuid4()->toString(),
            'email_verified_at' => Carbon::now(),
        ]);
        $AdminETBSA->clvPersona = $AdminETBSA->id;
        $AdminETBSA->save();
        $AdminETBSA->groups()->attach($groupSuperUser);

        //TODO. generate random users -> Origina SourceCode
        // $users = factory(User::class, 30)->create();
        // $users->each(function ($u) use ($groupDefaultUser) {
        //     $u->groups()->attach($groupDefaultUser);
        // });

        //* generate random users -> Modified And Functional
        User::factory()
            ->count(48)
            // ->state(new Sequence(
            //     ['email' => 'user1@example.com'],
            //     ['email' => 'user2@example.com'],
            //     ['email' => 'user3@example.com'],
            // ))
            ->create()
            ->each(function ($user) use ($groupDefaultUser) {
                $password = Str::random(12); // Generar una cadena aleatoria de 12 caracteres
                $user->password = substr($password, 0, rand(6, 12)); // Limitar la longitud de la cadena aleatoria entre 6 y 12 caracteres
                $user->groups()->attach($groupDefaultUser);
                $user->save();
                $user->clvPersona = $user->id;
                $user->save();
            });
    }
}
