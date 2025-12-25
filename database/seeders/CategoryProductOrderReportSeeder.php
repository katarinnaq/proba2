<?php

namespace Database\Seeders;

use App\Models\CategoryProductOrderReport;
use Illuminate\Database\Seeder;

class CategoryProductOrderReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryProductOrderReport::factory()->count(5)->create();
    }
}
