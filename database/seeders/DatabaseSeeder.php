<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use App\Models\BaseFolder;
use App\Models\BaseFolderAccess;
use App\Models\Division;
use App\Models\Permissions;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Role Seeder
        $name = [
            'admin',
            'user'
        ];

        foreach ($name as $name) {

            Role::create([
                'name' => $name
            ]);
        };


        // Permission Seeder
        $name = [
            'view',
            'edit'
        ];

        foreach ($name as $name) {

            Permission::create([
                'name' => $name
            ]);
        };


        // Division Seeder
        $name = [
            'Web Developer',
            'Ui/UX Design',
            'Streaming Tech',
            'Social Media Strategis'
        ];

        foreach ($name as $name) {
            Division::create([
                'name' => $name
            ]);
        };



        // Users Seeder
        // Create Admin
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            // 'division_id' => random_int(1, 4)
            // password
        ])->assignRole('admin');
        // $admin->;

        User::create([
            'name' => 'user 2',
            'username' => 'user2',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'division_id' => random_int(1, 4)
        ])->assignRole('user');


        User::create([
            'name' => 'Ridha',
            'username' => 'ahdirmai',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'division_id' => random_int(1, 4)
        ])->assignRole('admin');

        User::create([
            'name' => 'Rani',
            'username' => 'raniii',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'division_id' => random_int(1, 4)
        ])->assignRole('user');


        User::create([
            'name' => 'Syarbini',
            'username' => 'syarbini',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'division_id' => random_int(1, 4)
        ])->assignRole('user');


        // Base Folder Seeder
        $create = BaseFolder::create([
            'name' => 'Base Folder 1',
            'owner_id' => '1',
            'isPrivate' => 'public',
            'slug' => Str::random(30)
        ]);
        if ($create) {
            BaseFolderAccess::create([
                'basefolder_id' => $create->id,
                'permission_id' => '2',
                'user_id' => $create->owner_id
            ]);
        }

        $create = BaseFolder::create([
            'name' => 'Base Folder 2',
            'owner_id' => '2',
            'isPrivate' => 'private',
            'slug' => Str::random(30)
        ]);
        if ($create) {
            BaseFolderAccess::create([
                'basefolder_id' => $create->id,
                'permission_id' => '2',
                'user_id' => $create->owner_id
            ]);
        }

        $create = BaseFolder::create([
            'name' => 'Base Folder 3',
            'owner_id' => '1',
            'isPrivate' => 'public',
            'slug' => Str::random(30)
        ]);
        if ($create) {
            BaseFolderAccess::create([
                'basefolder_id' => $create->id,
                'permission_id' => '2',
                'user_id' => $create->owner_id
            ]);
        }

        $create = BaseFolder::create([
            'name' => 'Base Folder 4',
            'owner_id' => '1',
            'isPrivate' => 'private',
            'slug' => Str::random(30)
        ]);
        if ($create) {
            BaseFolderAccess::create([
                'basefolder_id' => $create->id,
                'permission_id' => '2',
                'user_id' => $create->owner_id
            ]);

            BaseFolderAccess::create([
                'basefolder_id' => $create->id,
                'permission_id' => '1',
                'user_id' => '2'
            ]);
        }
    }
}
