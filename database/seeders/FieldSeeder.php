<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\JsonDecoder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $fields = [];

        for ($index = 2; $index <= 10; $index++) {
            $fieldTypeId = ($index <= 5) ? 4 : 6;
            $id = ($index <= 5) ? "F-{$index}" : "B-{$index}";
            $fields[] = [
                'name' => ($id),
                'number' => $index,
                'field_image_url' => 'https://example.com/image.jpg',
                'location_id' => DB::table('location')->where('name', 'United')->first()->id,
                'field_type_id' => $fieldTypeId,
            ];
        }

        foreach ($fields as $field) {

            $field['created_at'] = now();
            $field['updated_at'] = now();
            DB::table('fields')->insert($field);
        }
    }
}
