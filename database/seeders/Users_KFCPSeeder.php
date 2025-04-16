<?php

namespace Database\Seeders;

use App\Models\Users_KFCP;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Users_KFCPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users_KFCP::factory(10)->create();
    }
}
