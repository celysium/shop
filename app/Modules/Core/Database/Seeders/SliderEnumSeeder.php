<?php

namespace App\Modules\Core\Database\Seeders;

use App\Modules\Core\Models\Slider;
use Exception;
use Illuminate\Database\Seeder;

class SliderEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Slider::storeEnums([
            ['field' => 'status', 'case' => 'inactive', 'cast' => 0],
            ['field' => 'status', 'case' => 'active', 'cast' => 1],
        ]);
    }
}
