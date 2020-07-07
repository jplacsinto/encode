<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
        	'name' => 'Admin User',
        	'email' => 'admin@admin.com',
        	'password' => Hash::make('adminadmin'),
            'active' => true
        ]);

        $author = User::create([
        	'name' => 'Author User',
        	'email' => 'author@author.com',
        	'password' => Hash::make('password'),
            'active' => true
        ]);

        $user = User::create([
        	'name' => 'Generic User',
        	'email' => 'user@user.com',
        	'password' => Hash::make('password'),
            'active' => true
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);


        $users = factory(User::class, 57)
           ->create()
           ->each(function ($user) use ($userRole) {
                $user->roles()->attach($userRole);
            });
    }
}
