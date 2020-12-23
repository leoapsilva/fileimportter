<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'first_name' => $this->faker->firstName($gender),
            'last_name' => $this->faker->lastName .' '. $this->faker->lastName,
            'email' => $this->faker->email,
            'gender' => $gender,
            'ip_address' => $this->faker->ipv4,
            'company' => $this->faker->company,
            'city' => $this->faker->city,
            'title' => $this->faker->title($gender),
            'website' => 'http://www.'. $this->faker->domainName,
        ];
    }
}
