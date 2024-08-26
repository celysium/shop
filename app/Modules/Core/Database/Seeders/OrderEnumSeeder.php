<?php

namespace App\Modules\Core\Database\Seeders;

use App\Modules\Core\Models\Order;
use Exception;
use Illuminate\Database\Seeder;

class OrderEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Order::storeEnums([
            ['field' => 'status', 'case' => 'new',       'cast' => 0],
            ['field' => 'status', 'case' => 'payment',   'cast' => 1],
            ['field' => 'status', 'case' => 'success',   'cast' => 2],
            ['field' => 'status', 'case' => 'failed',    'cast' => 3],
            ['field' => 'status', 'case' => 'process',   'cast' => 4],
            ['field' => 'status', 'case' => 'delivered', 'cast' => 5],
        ]);
    }
}
