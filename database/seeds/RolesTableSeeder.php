<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creating default roles
        $currentDateTime = Carbon::now()->toDateTimeString();
        $roles = [
            [
                'name' => 'admin',
                'notes' => 'Role for user-administrator',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'name' => 'librarian',
                'notes' => 'Role for user-librarian',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'name' => 'reader',
                'notes' => 'Role for user-reader',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
        ];
        DB::table('roles')->insert($roles);
    }
}
