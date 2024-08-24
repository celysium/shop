<?php

namespace App\Modules\Core\Database\Seeders;

use App\Modules\Core\Models\User;
use Exception;
use Illuminate\Database\Seeder;

class UserEnumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        User::storeEnums([
            ['field' => 'status', 'case' => 'inactive', 'cast' => 0],
            ['field' => 'status', 'case' => 'active', 'cast' => 1],

            ['field' => 'gender', 'case' => 'unknown', 'cast' => 0],
            ['field' => 'gender', 'case' => 'female', 'cast' => 1],
            ['field' => 'gender', 'case' => 'male', 'cast' => 2],
        ]);
    }
}
