<?php

namespace Database\Seeders;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'General', 'position' => 0],
            ['name' => 'Fun', 'position' => 0],
            ['name' => 'Work', 'position' => 0],
            ['name' => 'Daily', 'position' => 0],
        ]);
        User::create([
            'name'=> 'admin',
            'email'=> 'admin@admin.com',
            'password'=> 'password',
            'username'=> 'admin',
            'user_type'=> 'admin',
        ]);

        DB::table('roles')->insert([
            'name' => 'super_admin',
            'permissions' => 'a:1:{s:10:"fullAccess";i:1;}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('panel_admins')->insert([
            'is_superuser' => true,
            'user_id' => 1,
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('cruds')->insert([
            'name' => 'User',
            'model' => 'App\Models\User',
            'route' => 'user',
            'icon' => 'fa fa-user',
            'active' => 1,
            'built' => 1,
            'with_acl' => 1,
            'with_policy' => 1,
        ]);
        DB::table('cruds')->insert([
            'name' => 'Task',
            'model' => 'App\Models\Task',
            'route' => 'task',
            'icon' => 'fa fa-tasks',
            'active' => 1,
            'built' => 1,
            'with_acl' => 1,
            'with_policy' => 1,
        ]);
        DB::table('cruds')->insert([
            'name' => 'Category',
            'model' => 'App\Models\Category',
            'route' => 'category',
            'icon' => 'fa fa-cubes',
            'active' => 1,
            'built' => 1,
            'with_acl' => 1,
            'with_policy' => 1,
        ]);
    }
}
