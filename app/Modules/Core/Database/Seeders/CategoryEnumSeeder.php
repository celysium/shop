<?php

namespace App\Modules\Core\Database\Seeders;

use App\Modules\Core\Models\Category;
use Exception;
use Illuminate\Database\Seeder;

class CategoryEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Category::storeEnums([
            ['field' => 'status', 'case' => 'inactive', 'cast' => 0],
            ['field' => 'status', 'case' => 'active', 'cast' => 1],

            ['field' => 'visibility', 'case' => 'invisible', 'cast' => 0],
            ['field' => 'visibility', 'case' => 'visible', 'cast' => 1],
        ]);
    }
}
