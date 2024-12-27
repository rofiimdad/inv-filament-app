<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Asset;
use App\Models\Branch;
use App\Models\Barcode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EmployeeSeeder::class);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'test@test.test',
            'email' => 'test@test.test',
            'password' => Hash::make('test@test.test'),
        ]);

        Branch::factory()->create([
            'name' => 'Pusat',
            'base_office' => 'Head Office',
        ]);
        Branch::factory()->create([
            'name' => 'Madiun',
            'base_office' => 'Consumer Goods',
        ]);
        Branch::factory()->create([
            'name' => 'Gunungsari',
            'base_office' => 'Building Material',
        ]);

        Asset::factory()
            ->count(50)
            ->sequence(fn (Sequence $sequence) => [
                'asset_type' => 'Laptop',
                'asset_number' =>  Asset::generateAssetNumber('Laptop','01/01/2024', $sequence->index + 1 ),
                ])
            ->create();

        Barcode::factory()
        ->count(50)
        ->sequence(fn (Sequence $sequence) => [
            'asset_id' => $sequence->index + 1 ,
            'barcode_number' => fake()->regexify('[A-Z]{9}[0-9]{6}'),
            'status' => 'unused'
            ])
        ->create();


    }
}
