<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BuyerTest extends TestCase
{
    use RefreshDatabase;

    protected $buyer;
    protected $seller;
    protected $product;
    protected $transaction;
    protected $category;

    public function setUp(): void
    {
        parent::setUp();

        $categories = Category::factory()->count(5)->create();

        $this->seller = User::factory()->create();
        $this->buyer = User::factory()->create();

        $this->product = Product::factory()->state([
            'seller_id' => $this->seller->id,
        ])->create();

        $this->category = $categories->first();
        $this->product->categories()->attach($this->category->id);

        $this->transaction = Transaction::factory()->state([
            'buyer_id' => $this->buyer->id,
            'product_id' => $this->product->id,
        ])->create();
    }

    public function test_buyers_index()
    {
        $response = $this->get('/buyers');

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $this->buyer->id]);
    }

    public function test_buyers_show()
    {
        $response = $this->get("/buyers/{$this->buyer->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $this->buyer->id]);
    }

    public function test_buyers_transactions_index()
    {
        $response = $this->get("/buyers/{$this->buyer->id}/transactions");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $this->product->id]);
    }

    public function test_buyers_products_index()
    {
        $response = $this->get("/buyers/{$this->buyer->id}/products");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $this->product->id]);
    }

    public function test_buyers_sellers_index()
    {
        $response = $this->get("/buyers/{$this->buyer->id}/sellers");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $this->seller->id]);
    }

    public function test_buyers_categories_index()
    {
        $response = $this->get("/buyers/{$this->buyer->id}/categories");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $this->category->id]);
    }
}
