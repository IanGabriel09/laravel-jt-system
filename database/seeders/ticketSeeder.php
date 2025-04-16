<?php

namespace Database\Seeders;

use App\Models\ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ticketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ticket::factory()->count(200)->create();
    }
}
