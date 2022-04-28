<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->truncateTables(['documentos', 'solicitudes', 'idioma_user', 'idiomas', 'users']);
        $this->deleteUserDocuments();
        $this->call(CicloSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IdiomaSeeder::class);
    }

    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function deleteUserDocuments(){
        Storage::deleteDirectory("public/UserDocuments");
    }
}
