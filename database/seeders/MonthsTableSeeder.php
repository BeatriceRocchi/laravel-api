<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];

        foreach ($months as $item) {
            $month = new Month();

            $month->name = $item;
            $month->save();
        }
    }
}
