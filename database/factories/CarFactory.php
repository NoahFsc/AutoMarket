<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_of_car' => $this->faker->word,
            'car_year' => $this->faker->year,
            'mileage' => $this->faker->numberBetween(0, 200000),
            'consommation' => $this->faker->randomFloat(2, 3, 15),
            'nb_door' => $this->faker->numberBetween(2, 5),
            'provenance' => $this->faker->country,
            'puissance_fiscale' => $this->faker->numberBetween(1, 15),
            'puissance_din' => $this->faker->numberBetween(50, 500),
            'boite_vitesse' => $this->faker->randomElement([0, 1]),
            'carburant' => $this->faker->randomElement(['essence', 'diesel', 'électrique', 'hybride']),
            'vente_enchere' => $this->faker->boolean,
            'minimum_price' => $this->faker->randomFloat(2, 1000, 50000),
            'selling_price' => $this->faker->randomFloat(2, 1000, 50000),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 year'),
            'crit_air' => $this->faker->numberBetween(0, 5),
            'co2_emission' => $this->faker->numberBetween(50, 300),
            'status' => $this->faker->randomElement([1, 0]),
            'user_id' => 1,
            'model_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
