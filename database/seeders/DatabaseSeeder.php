<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now(),
            'password'  => '12345678',
            'role'  => 1
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'email_verified_at' => Carbon::now(),
            'password'  => '12345678',
            'role'  => 2
        ]);

        Brand::create([
            'brand_name'    => 'Honda',
            'company_name'  => 'PT Astra Honda Motor',
            'logo'          => 'honda.jpg'
        ]);

        $this->call([
            ProductSeeder::class,
            SpecSeeder::class,
        ]);


    }
}
