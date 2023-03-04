<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Transaction;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Employee::create([
            'badge_number' => '802039',
            'full_name' => 'Noreen Fatima'
        ]);

        Employee::create([
            'badge_number' => '110101',
            'full_name' => 'Jericho Rosales'
        ]);

        Employee::create([
            'badge_number' => '0x123',
            'full_name' => 'Cyril Pogi'
        ]);

        Position::create(['position' => 'Super Admin']);
        Position::create(['position' => 'Admin']);
        Position::create(['position' => 'Logistics']);
    }
}
