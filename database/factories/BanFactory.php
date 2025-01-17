<?php

namespace Albert\Waf\Database\Factories;

use Albert\Waf\Models\Ban;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @template TModel of \Albert\Waf\Models\Ban
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class BanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = Ban::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip_address' => fake()->ipv4(),
            'banned_until' => Carbon::tomorrow(),
        ];
    }

    /**
     * Setups a expired ban.
     */
    public function expired(): static
    {
        return $this->state(fn () => [
            'banned_until' => Carbon::yesterday(),
        ]);
    }
}
