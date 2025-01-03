<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Darryldecode\Cart\Cart;

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

    public function test_remove()
    {
        \Cart::add(array(
            'id' => 1,
            'name' => 'Product 1',
            'price' => 100,
            'quantity' => 1

        ));
        $response = $this->post(route('cart.remove'), [
            'id' => 1
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('success_msg', 'Producto removido!');
        $this->assertEquals(0, \Cart::getTotal());
    }

    public function test_clear()
    {
        \Cart::add(array(
            'id' => 1,
            'name' => 'Product 1',
            'price' => 100,
            'quantity' => 1

        ));
        $response = $this->post(route('cart.clear'));
        $response->assertStatus(302);
        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('success_msg', 'Carrito borrado!');
        $this->assertEquals(0, \Cart::getTotal());
    }
}
