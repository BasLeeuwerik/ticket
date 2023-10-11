<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::factory()
        ->count(100)
        ->create();
    }
}
