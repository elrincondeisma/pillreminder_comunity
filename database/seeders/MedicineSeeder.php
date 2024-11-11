<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = count(MedicineFactory::medicines());
        Medicine::factory()->count($count)->create();
    }
}
