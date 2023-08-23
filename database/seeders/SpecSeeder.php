<?php

namespace Database\Seeders;

use App\Models\Specification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'type_id' => 1,
                'spec' => 'Machine',
                'name' => 'Tipe Mesin',
                'value' => '4 - Langkah, SOHC, eSP'
            ],
            [
                'type_id' => 1,
                'spec' => 'Machine',
                'name' => 'Volume Langkah',
                'value' => '109.5cc'
            ],
            [
                'type_id' => 1,
                'spec' => 'Machine',
                'name' => 'Diameter X Langkah',
                'value' => '47.0 x 63.1 mm'
            ],
            [
                'type_id' => 1,
                'spec' => 'Frame',
                'name' => 'Tipe Rangka',
                'value' => 'eSAF (enhance Smart Architecture Frame)'
            ],
            [
                'type_id' => 1,
                'spec' => 'Frame',
                'name' => 'Tipe Suspensi Depan',
                'value' => 'Telescopic'
            ],
            [
                'type_id' => 1,
                'spec' => 'Dimension',
                'name' => 'P x L x T',
                'value' => '1.877 x 669 x 1.074 mm'
            ],
            [
                'type_id' => 1,
                'spec' => 'Dimension',
                'name' => 'Curb Weight',
                'value' => '89 Kg'
            ],
            [
                'type_id' => 1,
                'spec' => 'Capacity',
                'name' => 'Tangki Bahan Bakar',
                'value' => '4.2 Liter'
            ],
            [
                'type_id' => 1,
                'spec' => 'Capacity',
                'name' => 'Minyak Pelumas',
                'value' => '0.65 Liter'
            ],
            [
                'type_id' => 1,
                'spec' => 'Electricity',
                'name' => 'Tipe Aki',
                'value' => 'BeAT MF 12V-3Ah'
            ],
            [
                'type_id' => 1,
                'spec' => 'Electricity',
                'name' => 'Tipe Busi',
                'value' => 'NGK MR9C-9N'
            ],
            [
                'type_id' => 2,
                'spec' => 'Machine',
                'name' => 'Tipe Mesin',
                'value' => '4 - Langkah, SOHC, eSP'
            ],
            [
                'type_id' => 2,
                'spec' => 'Machine',
                'name' => 'Volume Langkah',
                'value' => '109.5cc'
            ],
            [
                'type_id' => 2,
                'spec' => 'Machine',
                'name' => 'Diameter X Langkah',
                'value' => '47.0 x 63.1 mm'
            ],
            [
                'type_id' => 2,
                'spec' => 'Frame',
                'name' => 'Tipe Rangka',
                'value' => 'eSAF (enhance Smart Architecture Frame)'
            ],
            [
                'type_id' => 2,
                'spec' => 'Frame',
                'name' => 'Tipe Suspensi Depan',
                'value' => 'Telescopic'
            ],
            [
                'type_id' => 2,
                'spec' => 'Dimension',
                'name' => 'P x L x T',
                'value' => '1.877 x 669 x 1.074 mm'
            ],
            [
                'type_id' => 2,
                'spec' => 'Dimension',
                'name' => 'Curb Weight',
                'value' => '89 Kg'
            ],
            [
                'type_id' => 2,
                'spec' => 'Capacity',
                'name' => 'Tangki Bahan Bakar',
                'value' => '4.2 Liter'
            ],
            [
                'type_id' => 2,
                'spec' => 'Capacity',
                'name' => 'Minyak Pelumas',
                'value' => '0.65 Liter'
            ],
            [
                'type_id' => 2,
                'spec' => 'Electricity',
                'name' => 'Tipe Aki',
                'value' => 'BeAT MF 12V-3Ah'
            ],
            [
                'type_id' => 2,
                'spec' => 'Electricity',
                'name' => 'Tipe Busi',
                'value' => 'NGK MR9C-9N'
            ],
        ];

        foreach ($data as $specData) {
            Specification::create($specData);
        }
    }
}
