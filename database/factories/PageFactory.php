<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeInInterval('-2 weeks', '+2 weeks');

        return [
            'uuid' => $this->faker->uuid(),
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}
