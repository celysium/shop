<?php

namespace App\Modules\Core\Database\Seeders;

use App\Modules\Core\Models\Product;
use Exception;
use Illuminate\Database\Seeder;

class ProductEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Product::storeEnums([
            ['field' => 'status', 'case' => 'inactive', 'cast' => 0],
            ['field' => 'status', 'case' => 'active',   'cast' => 1],

            ['field' => 'visibility', 'case' => 'invisible', 'cast' => 0],
            ['field' => 'visibility', 'case' => 'visible',   'cast' => 1],

            ['field' => 'type', 'case' => 'simple',       'cast' => 0],
            ['field' => 'type', 'case' => 'bundle',       'cast' => 1],
            ['field' => 'type', 'case' => 'configurable', 'cast' => 2],
            ['field' => 'type', 'case' => 'variant',      'cast' => 3],
            ['field' => 'type', 'case' => 'virtual',      'cast' => 4],
        ]);
    }
}
