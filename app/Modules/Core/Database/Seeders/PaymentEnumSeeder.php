<?php

namespace App\Modules\Core\Database\Seeders;

use App\Modules\Core\Models\Payment;
use Exception;
use Illuminate\Database\Seeder;

class PaymentEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Payment::storeEnums([
            ['field' => 'status', 'case' => 'new',     'cast' => 0],
            ['field' => 'status', 'case' => 'pending', 'cast' => 1],
            ['field' => 'status', 'case' => 'success', 'cast' => 2],
            ['field' => 'status', 'case' => 'failed',  'cast' => 3],
        ]);
    }
}
