<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'brand_id'  => 1,
            'product_name'  => 'Honda BeAT',
        ]);

        Type::create([
            'product_id'    => 1,
            'type_name'     => 'BeAT CBS',
            'price'         => 18000000,
            'image'         => 'beat_cbs.webp'
        ]);

        Type::create([
            'product_id'    => 1,
            'type_name'     => 'BeAT Street',
            'price'         => 20000000,
            'image'         => 'beat_street.webp'
        ]);

        Order::create([
            'type_id'       => 1,
            'user_id'     => 2
        ]);

        Order::create([
            'type_id'       => 2,
            'user_id'     => 2
        ]);
    }
}
