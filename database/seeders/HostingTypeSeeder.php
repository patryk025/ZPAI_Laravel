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
        HostingType::factory()->count(50)->create();
    }
}
