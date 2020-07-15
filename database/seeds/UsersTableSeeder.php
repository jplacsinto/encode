<?php

use Illuminate\Database\Seeder;
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
        $editorRole = Role::where('name', 'editor')->first();

        $admin = User::create([
        	'name' => 'Admin User',
        	'email' => 'admin@admin.com',
        	'password' => 'password',
            'active' => true
        ]);

        $editor = User::create([
        	'name' => 'Editor User',
        	'email' => 'editor@editor.com',
        	'password' => 'password',
            'active' => true
        ]);

        $admin->roles()->attach($adminRole);
        $editor->roles()->attach($editorRole);


        $users = factory(User::class, 30)
           ->create()
           ->each(function ($user) use ($editorRole) {
                $user->roles()->attach($editorRole);
            });
    }
}
