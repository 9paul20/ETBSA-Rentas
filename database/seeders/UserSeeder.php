<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            ->each(function ($user) {
                $password = Str::random(12); // Generar una cadena aleatoria de 12 caracteres
                $user->password = substr($password, 0, rand(6, 12)); // Limitar la longitud de la cadena aleatoria entre 6 y 12 caracteres
                $user->save();
                $user->clvPersona = $user->id;
                $user->save();
            });
    }
}
