<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = \App\Models\item::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $year = $this->faker->year();
        return [
            //
            'title' => "Member-{$year}",
            'year' => $year,
            'amount' => $this->faker->randomNumber(3),
        ];
    }
}
