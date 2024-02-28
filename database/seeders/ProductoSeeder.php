<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //para ejecutar un seeder 
        //php artisan db:seed --class=NombreDelSeeder


        Producto::create([
            'name' => 'Almanaque Anillado',
            'alias' => 'AA14x15',
            'slug' => 'almanaque-anillado',
            // 'details' => '15 pulgadas, 1TB HDD, 32GB RAM',
            'price' => 3393,
            // 'shipping_cost' => 29.99,
            'description' => 'Almanaque Anillado 14 x 15 cm',
            'category_id' => 1,
            // 'brand_id' => 1,
            'image_path' => '/storage/dHILNFqAWu2t1RqIkeBzDasA53X5MyGmcIdCq9IV.jpg'
        ]);
        Producto::create([
            'name' => 'Carpetas de Presentación',
            'alias' => 'CP30x40',
            'slug' => 'carpeta-presentacion',
            // 'details' => '15 pulgadas, 1TB HDD, 32GB RAM',
            'price' => 1950.32,
            // 'shipping_cost' => 29.99,
            'description' => ' 30 x 40 cm',
            'category_id' => 1,
            // 'brand_id' => 1,
            'image_path' => '/storage/gRiyp82dYfxgMtYymZxmASznBk8GWWD1b6NiEOr5.jpg'
        ]);

        // \App\Models\Producto::factory(100)->create();
        // Producto::create([
        //     'name' => 'Volantes Flyers Folletos',
        //     'slug' => 'flyres',
        //     // 'details' => '15 pulgadas, 1TB HDD, 32GB RAM',
        //     'price' => 19374.32,
        //     // 'shipping_cost' => 29.99,
        //     'description' => '10 x 15cm',
        //     'category_id' => 1,
        //     // 'brand_id' => 1,
        //     'image_path' => 'flyers-pymedia'
        // ]);
        // Producto::create([
        //     'name' => 'Señaladores',
        //     'slug' => 'señaladores',
        //     // 'details' => '15 pulgadas, 1TB HDD, 32GB RAM',
        //     'price' => 19374.32,
        //     // 'shipping_cost' => 29.99,
        //     'description' => '5 x 15 cm',
        //     'category_id' => 1,
        //     // 'brand_id' => 1,
        //     'image_path' => 'señaladores-pymedia'
        // ]);
        // Producto::create([
        //     'name' => 'Tarjetas Personales',
        //     'slug' => 'tarjetas-personales',
        //     // 'details' => '15 pulgadas, 1TB HDD, 32GB RAM',
        //     'price' => 218.44,
        //     // 'shipping_cost' => 29.99,
        //     'description' => '9 x 5 cm',
        //     'category_id' => 1,
        //     // 'brand_id' => 1,
        //     'image_path' => 'tarjetas-pymedia'
        // ]);
    }
}
