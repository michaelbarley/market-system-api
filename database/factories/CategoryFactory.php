<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Electronics', 'Fashion', 'Home & Kitchen', 'Health & Beauty', 'Sports & Outdoors', 'Books & Media', 'Toys & Games', 'Automotive', 'Groceries', 'Office Supplies'];

        return [
            'name' => $this->faker->unique()->randomElement($categories),
            'description' => $this->faker->paragraph(1),
        ];
    }
}
