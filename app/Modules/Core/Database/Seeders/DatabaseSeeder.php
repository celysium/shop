<?php

namespace App\Modules\Core\Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LocationSeeder::class);
        $this->call(BannerEnumSeeder::class);
        $this->call(CategoryEnumSeeder::class);
        $this->call(DeliveryEnumSeeder::class);
        $this->call(SliderEnumSeeder::class);
        $this->call(UserEnumSeeder::class);
        $this->call(WidgetEnumSeeder::class);
        $this->call(PaymentEnumSeeder::class);
        $this->call(OrderEnumSeeder::class);
    }
}
