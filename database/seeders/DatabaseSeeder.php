<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         $roles = [
            ['id'=> 1,'name'=> 'user' ],
            ['id'=> 2,'name'=> 'admin' ],
            ['id'=> 3,'name'=> 'engineer' ],
          ];
        DB::table('roles')->insertOrIgnore($roles);

         $user = [
            ['id'=> 1,
            'name'=> 'just',
            'email'=> 'm@a.com',
            'phone'=> '01010239332',
            'password'=> bcrypt('12345678'),
            'role_id'=> '2',
            'company'=> 'Just Company',
            'address'=> 'Zag',
        ],
          ];
        DB::table('users')->insertOrIgnore($user);

    }
}
