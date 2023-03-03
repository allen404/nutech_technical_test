<?php

namespace Database\Seeders;

use App\Models\Barang;
use Database\Factories\BarangFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Barang::factory()->count(30)->create();

        //
    }
}
