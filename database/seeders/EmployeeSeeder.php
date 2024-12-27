<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/datakary.json');

        // Baca file JSON
        if (File::exists($jsonPath)) {
            $json = File::get($jsonPath);
            $data = json_decode($json, true);

            // Insert data ke table
            foreach ($data as $item) {
                // Log::info($item);
                Employee::create([
                    'nik' => $item['nik'],
                    'name' => $item['name'],
                    'departement' => $item['departement'],
                ]);
            }

            $this->command->info('Data berhasil di-seed dari file JSON!');
        } else {
            $this->command->error('File JSON tidak ditemukan!');
        }
    }
}
