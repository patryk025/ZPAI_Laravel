<?php

namespace Database\Seeders;

use App\Models\HostingType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HostingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HostingType::create([
            'name' =>'Podstawowy'
        ]);

        HostingType::create([
            'name' =>'Średni'
        ]);

        HostingType::create([
            'name' =>'Dla firm'
        ]);

        HostingType::create([
            'name' =>'Dla studentów'
        ]);

        HostingType::create([
            'name' =>'Pakiet pełny'
        ]);
    }
}
