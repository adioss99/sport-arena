<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Rush Badminton',
                'province' => 'Jawa Timur',
                'regency' => 'Jember',
                'distric' => 'Sumbersari',
                'detail_address' => 'Kalimantan',
                'gmaps' => 'null',
                'field_image_url' => 'null',
                'owner_id' => User::where('name', 'Admin User')->first()->id,
            ],
            [
                'name' => 'Lapangan 8',
                'province' => 'Jawa Timur',
                'regency' => 'Jember',
                'distric' => 'Ajung',
                'detail_address' => '-',
                'gmaps' => 'null',
                'field_image_url' => 'null',
                'owner_id' => User::where('name', 'asdasd')->first()->id,
            ],            
            [
                'name' => 'United',
                'province' => 'Jawa Timur',
                'regency' => 'Jember',
                'distric' => 'Majapahit',
                'detail_address' => '-',
                'gmaps' => 'null',
                'field_image_url' => 'null',
                'owner_id' => User::where('name', 'united admin')->first()->id,
            ],            
        ];

        foreach ($locations as $location) {
            $slugBase = Str::slug("{$location['name']}-{$location['regency']}-{$location['distric']}");
            $count = DB::table('location')->where('slug', 'LIKE', "$slugBase%")->count();
            $slug = $count ? "{$slugBase}-{$count}" : $slugBase;

            DB::table('location')->insert([
                'name' => $location['name'],
                'province' => $location['province'],
                'regency' => $location['regency'],
                'distric' => $location['distric'],
                'slug' => $slug,
                'detail_address' => $location['detail_address'],
                'gmaps' => $location['gmaps'],
                'field_image_url' => $location['field_image_url'],
                'owner_id' => $location['owner_id'],
            ]);
        }
    }
}
