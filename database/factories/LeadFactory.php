<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $emailStatuses = ['valid', 'invalid', 'unknown', 'catch-all'];
        $genders = ['male', 'female', 'other'];
        $personas = ['decision_maker', 'influencer', 'end_user', 'gatekeeper'];
        $countryCodes = ['US', 'GB', 'IN', 'CA', 'AU', 'DE', 'FR', 'SG'];
 
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();
 
        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'email_status' => $this->faker->randomElement($emailStatuses),
            'company_name' => $this->faker->company(),
            'position_title' => $this->faker->jobTitle(),
            'position_location' => $this->faker->city(),
            'industry_name' => $this->faker->randomElement([
                'Software', 'Finance', 'Healthcare', 'Retail', 'Manufacturing',
                'Education', 'Real Estate', 'Telecommunications', 'Hospitality',
            ]),
            'location' => $this->faker->city().', '.$this->faker->country(),
            'country_code' => $this->faker->randomElement($countryCodes),
            'persona' => $this->faker->randomElement($personas),
            'gender' => $this->faker->randomElement($genders),
        ];
    }
}
