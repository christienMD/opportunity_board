<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Opportunity>
 */
class OpportunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'img_url' => fake()->imageUrl(),
            'category' => fake()->randomElement(['Job', 'Internship', 'Volunteer']),
            'status' => 'Pending',
            'closing_date' => fake()->optional()->date(),
            'published_at' => fake()->optional()->dateTime(),
            'user_id' => fake()->numberBetween(1, 10),
        ];
    }

        /**
         * Indicate that the opportunity is Published.
         */
        public function published(): static
        {
            return $this->state(fn (array $attributes) => [
                'status' => 'Published',
                'published_at' => now(),
            ]);
        }
}
