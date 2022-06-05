<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class membershipFactory extends Factory
{
    protected $model = \App\Models\membership::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'gvBrowseCode' => $this->faker->unique()->randomNumber(6),
            'gvBrowseCompanyName' => $this->faker->company(),
            'gvBrowseAttention' => $this->faker->name(),
            'gvBrowseUDF_TEMPATLAHIR' => $this->faker->city(),
            'gvBrowseUDF_ICNO' => $this->faker->unique()->randomNumber(6),
            'gvBrowsePhone1' => $this->faker->phoneNumber(),
            'gvBrowseAddress1' => $this->faker->address(),
            'gvBrowseArea' => $this->faker->city(),
            'gvBrowseUDF_DOB' => $this->faker->date(),
            'gvBrowseUDF_NOAHLISKMC' => $this->faker->unique()->randomNumber(6),
            'gvBrowseUDF_TARIKHMEMOHON' => $this->faker->date(),
            'gvBrowseUDF_PEKERJAAN' => $this->faker->jobTitle(),
            'gvBrowseUDF_JANTINA' => $this->faker->randomElement(['Lelaki', 'Perempuan']),
        ];
    }
}
