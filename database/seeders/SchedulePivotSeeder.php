<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulePivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
        ];

        for ($i = 0; $i < 23; $i++) {
            $field_id = $i + 1;
            if ($field_id < 5) {
                for ($j = 7; $j <= 23; $j++) {
                    $schedules[] = [
                        'field_id' => $field_id,
                        'schedule_id' => $j,
                    ];
                }
            } elseif ($field_id >5 && $field_id < 13) {
                for ($j = 10; $j <= 24; $j++) {
                    $schedules[] = [
                        'field_id' => $field_id,
                        'schedule_id' => $j,
                    ];
                }
            } else {
                for ($j = 7; $j < 23; $j++) {
                    $schedules[] = [
                        'field_id' => $field_id,
                        'schedule_id' => $j,
                    ];
                }
            }
        }
        DB::table('schedule_pivot')->insert($schedules);
    }
}
