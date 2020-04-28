<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creating default users
        $users = [
            [
                'role_id' => 1,
                'readercard_id' => 1,
                'name' => 'ПІБ адміністратора',
                'email' => 'admin@g.g',
                'password' => bcrypt('Admin'),
            ],
            [
                'role_id' => 2,
                'readercard_id' => 2,
                'name' => 'ПІБ бібліотекара',
                'email' => 'librarian@g.g',
                'password' => bcrypt('Librarian'),
            ],
            [
                'role_id' => 3,
                'readercard_id' => 3,
                'name' => 'ПІБ читача',
                'email' => 'reader@g.g',
                'password' => bcrypt('Reader'),
            ],
        ];
        DB::table('users')->insert($users);
    }
}
