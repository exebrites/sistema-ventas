<?php

namespace Tests\Feature;

use App\Models\CostoDisenio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CartTest extends TestCase
{
    use RefreshDatabase;
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


    public function test_add()
    {

        CostoDisenio::create([ //crea un costo disenio en la base de datos
            'hora_disenio' => 500,
            'horas_disenio_completo' => 5,
            'horas_disenio_asistido' => 2,
            'porcentaje_costo' => 0.5
        ]);
        // Simula el sistema de almacenamiento
        Storage::fake('local');

        // Crea una imagen falsa
        $image = UploadedFile::fake()->image('example.jpg', 600, 400);


        // 1. Pasaje de paramatros
        $response  = $this->post(route('cart.store'), [
            'id' => 1,
            'name' => 'Product 1',
            'price' => 100,
            'img' => 'file',
            'slug' => 'cosito',
            'quantity' => 1,
            'disenio_estado' => true,
            'file' => $image //2. Validacion de archivo

        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('success_msg', 'Producto agregado a su Carrito!');
    }

    public function test_add_boceto()
    {
        CostoDisenio::create([ //crea un costo disenio en la base de datos
            'hora_disenio' => 500,
            'horas_disenio_completo' => 5,
            'horas_disenio_asistido' => 2,
            'porcentaje_costo' => 0.5
        ]);

        // Simula el sistema de almacenamiento
        Storage::fake('local');

        // Crea una imagen falsa
        $logo = UploadedFile::fake()->image('logo.jpg', 600, 400);
        $img = UploadedFile::fake()->image('img.jpg', 600, 400);

        $response  = $this->post(route('cart.store_boceto'), [
            'id' => 1,
            'name' => 'Product 1',
            'price' => 100,
            'img_path' => 'file',
            'slug' => 'cosito',
            'quantity' => 1,
            'disenio_estado' => false,
            'logo' => $logo,
            'img' => $img,
            'nombre' => 'Product 1',
            'objetivo' => 'Product 1',
            'publico' => 'Product 1',
            'contenido' => 'Product 1',

        ]);



        $response->assertStatus(302);
        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('success_msg', 'Producto agregado a su Carrito!');
    }
}
