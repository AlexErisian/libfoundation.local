<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ReadercardsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(LibrariesTableSeeder::class);
        $this->call(PrintingAuthorsTableSeeder::class);
        $this->call(PrintingGenresTableSeeder::class);
        $this->call(PrintingPubhousesTableSeeder::class);
        $this->call(PrintingTypesTableSeeder::class);
        $this->call(PrintingsTableSeeder::class);
        $this->call(PrintingGenreTableSeeder::class);
        $this->call(PrintingCommentsTableSeeder::class);
        $this->call(BookshelvesTableSeeder::class);
        $this->call(PrintingRegistrationsTableSeeder::class);
    }
}
