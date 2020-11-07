<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            'name' => 'Paket',
        ], [
            'name' => 'Pengayaan',
        ], [
            'name' => 'Cerpen',
        ], [
            'name' => 'Referensi',
        ], [
            'name' => 'Surat Kabar',
        ]);
    }
}
