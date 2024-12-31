<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Producto;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_product()
    {
        // Datos de prueba
        // protected $fillable = ['name', 'price', 'slug', 'description', 'category_id', 'image_path', 'alias', 'visitas'];

        $data = [
            'name' => 'Laptop',
            // 'slug' => 'Laptop',
            // 'description' => 'A powerful laptop',
            'price' => '1200.50',
            'category_id' => '1',
            // 'image_path' => 'image_path',
            // 'alias' => 'alias',
            // 'visitas' => 0
        ];



        // Enviar solicitud POST
        $producto = Producto::create($data);
        // echo $response;
        // Verificar que el producto fue creado en la base de datos
        $this->assertDatabaseHas('productos', $data);

        // Verificar redirección y mensaje de éxito
        // $this->assertRedirect(route('productos.index'));
        // $response->assertSessionHas('success', 'Product created successfully!');
    }

    public function test_store_validates_data()
    {
        // Enviar datos inválidos
        $response = $this->post('/productos', [
            'name' => '',
            'price' => 'not-a-number',
        ]);

        // Verificar que los errores de validación son correctos
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'price']);
    }
}
