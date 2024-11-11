<?php

namespace Database\Factories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Medicine::class;

    public function definition(): array
    {
        $medicines = $this->medicines();
        return [
            'name' => $this->faker->unique()->randomElement($medicines),
            'description' => $this->faker->sentence(),
            'is_active' => $this->faker->boolean(50), // 50% de probabilidad de estar activo
            'image' => $this->faker->imageUrl(640, 480, 'medicine', true, 'Medical')
        ];
    }
    public static function medicines(): array
    {
        return [
            'Paracetamol',
            'Ibuprofeno',
            'Amoxicilina',
            'Ciprofloxacino',
            'Azitromicina',
            'Metformina',
            'Simvastatina',
            'Omeprazol',
            'Losartán',
            'Amlodipino'
        ];
    }
}
