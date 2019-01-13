<?php

use App\Feature;
use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = [
            ['id' => 1, 'name' => 'Air Conditioning'],
            ['id' => 2, 'name' => 'Swimming Pool'],
            ['id' => 3, 'name' => 'Garden'],
            ['id' => 4, 'name' => 'Parking'],
            ['id' => 5, 'name' => 'Furnished'],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
