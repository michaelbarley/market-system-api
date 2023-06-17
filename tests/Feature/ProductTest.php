<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function it_marks_a_product_as_unavailable_when_its_quantity_reaches_zero()
    {
        Category::factory()->count(5)->create();

        $product = Product::factory()->state([
            'quantity' => 1,
            'seller_id' => User::factory()->create(),
        ])->create();

        $product->update(['quantity' => 0]);

        $this->assertEquals(Product::UNAVAILABLE_PRODUCT, $product->fresh()->status);
    }
}
