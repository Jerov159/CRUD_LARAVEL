<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Analgésicos', 'description' => 'Medicamentos para aliviar el dolor'],
            ['name' => 'Antibióticos', 'description' => 'Medicamentos para combatir infecciones bacterianas'],
            ['name' => 'Antiinflamatorios', 'description' => 'Medicamentos para reducir la inflamación'],
            ['name' => 'Vitaminas', 'description' => 'Suplementos vitamínicos y minerales'],
            ['name' => 'Dermatológicos', 'description' => 'Productos para el cuidado de la piel'],
            ['name' => 'Antigripales', 'description' => 'Medicamentos para resfriados y gripe'],
            ['name' => 'Gastrointestinales', 'description' => 'Medicamentos para problemas digestivos'],
            ['name' => 'Antialérgicos', 'description' => 'Medicamentos para alergias'],
            ['name' => 'Cardiovasculares', 'description' => 'Medicamentos para el corazón y circulación'],
            ['name' => 'Diabetes', 'description' => 'Medicamentos e insumos para diabéticos'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
