<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'detail' => 'Karpet',
                'price_per_hour' => 35000,
                'location_id' => 1,
            ],
            [
                'detail' => 'Karpet',
                'price_per_hour' => 35000,
                'location_id' => 2,
            ],
            [
                'detail' => 'PLester',
                'price_per_hour' => 25000,
                'location_id' => 2,
            ],
            [
                'detail' => 'Futsal-1',
                'price_per_hour' => 100000,
                'location_id' => 3,
            ],
            [
                'detail' => 'minisoccer',
                'price_per_hour' => 150000,
                'location_id' => 3,
            ],
            [
                'detail' => 'badminton',
                'price_per_hour' => 30000,
                'location_id' => 3,
            ],
        ];
        DB::table('field_type')->insert($types);
    }
}
