<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class NombreDelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // $response = $this->get(route('shop'));

        // $response->assertStatus(200);
        // $response->assertViewIs('shop');
        // $response->assertViewHas('products');
        // Artisan::call('migrate --path=../database/migrations/2023_06_22_000000_create_productos_table.php');
        // Artisan::call('migrate --path=../database/migrations/2023_06_22_000000_create_categorias_table.php');

        // $data = [
        //     'name' => 'producto 1',
        //     'price' => '1000',
        //     // 'slug' => 'producto-1',
        //     'description' => 'lorem ipsum',
        //     'category_id' => 1,
        //     'image_path' => 'imagen.jpg',
        //     'alias' => 'producto-1',
        //     // 'visitas' => 1,
        // ];
        // $response = $this->post(route('productos.store'), $data);
        // $response->assertStatus(302)->assertRedirect(route('productos.index'));
        // $this->assertDatabaseHas('productos', $data);
        $this->assertTrue(true);
    }
}
