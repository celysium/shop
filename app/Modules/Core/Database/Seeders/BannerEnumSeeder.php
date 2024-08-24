<?php

namespace App\Modules\Core\Database\Seeders;

use App\Modules\Core\Models\Banner;
use Exception;
use Illuminate\Database\Seeder;

class BannerEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Banner::storeEnums([
            ['field' => 'status', 'case' => 'inactive', 'cast' => 0],
            ['field' => 'status', 'case' => 'active', 'cast' => 1],
        ]);
    }
}
