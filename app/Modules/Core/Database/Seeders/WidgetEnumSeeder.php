<?php

namespace App\Modules\Core\Database\Seeders;

use App\Modules\Core\Models\Widget;
use Exception;
use Illuminate\Database\Seeder;

class WidgetEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Widget::storeEnums([
            ['field' => 'status', 'case' => 'inactive', 'cast' => 0],
            ['field' => 'status', 'case' => 'active', 'cast' => 1],
        ]);
    }
}
