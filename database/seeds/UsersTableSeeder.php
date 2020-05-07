<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds. Creating default users.
     *
     * @return void
     */
    public function run()
    {
        $currentDateTime = Carbon::now()->toDateTimeString();
        $users = [
            [
                'role_id' => 1,
                'readercard_id' => 1,
                'name' => 'ПІБ адміністратора',
                'email' => 'admin@g.g',
                'password' => bcrypt('Admin'),
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'role_id' => 2,
                'readercard_id' => 2,
                'name' => 'ПІБ бібліотекара',
                'email' => 'librarian@g.g',
                'password' => bcrypt('Librarian'),
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'role_id' => 3,
                'readercard_id' => 3,
                'name' => 'ПІБ читача',
                'email' => 'reader@g.g',
                'password' => bcrypt('Reader'),
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
        ];
        DB::table('users')->insert($users);
    }
}
