<?php

namespace App\Modules\Core\Database\Seeders;

use App\Modules\Core\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = json_decode(file_get_contents(__DIR__ . '/locations.json'), true);
        foreach ($data['locations'] as $item) {
            Location::query()
                ->create([
                    'id'        => $item['id'],
                    'parent_id' => $item['parent_id'],
                    'name'      => $item['name']
                ]);
        }
    }
}
