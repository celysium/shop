<?php

namespace App\Modules\Core\Database\Seeders;

use App\Modules\Core\Models\Cart;
use Exception;
use Illuminate\Database\Seeder;

class CartEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Cart::storeEnums([
            ['field' => 'status', 'case' => 'new',  'cast' => 0],
            ['field' => 'status', 'case' => 'hold', 'cast' => 1],
        ]);
    }
}
