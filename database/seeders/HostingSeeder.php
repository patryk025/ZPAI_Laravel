<?php

namespace Database\Seeders;

use App\Models\Hosting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hosting::factory()->count(50)->create();
    }
}
