<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_shop()
    {
        $response = $this->get(route('shop'));
        $response->assertStatus(200);
        $response->assertViewIs('shop');
    }
    public function test_cart()
    {
        $response = $this->get(route('cart.index'));
        $response->assertStatus(200);
        $response->assertViewIs('cart');
    }
}
