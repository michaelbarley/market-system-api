<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function setBuyerId(int $value)
    {
        return $this->state(function () use ($value) {
            return [
                'buyer_id' => $value,
            ];
        });
    }

    public function setProductId(int $value)
    {
        return $this->state(function () use ($value) {
            return [
                'product_id' => $value,
            ];
        });
    }

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
