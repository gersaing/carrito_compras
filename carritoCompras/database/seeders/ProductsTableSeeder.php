<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'PRO_NAME' => 'MacBook Pro',
            'PRO_DESCRIPTION' => '15 pulgadas, 1TB HDD, 32GB RAM',
            'PRO_PRICE' => 2499.99,
            'PRO_IMG' => 'macbook-pro.png',
        ]);

        Producto::create([
            'PRO_NAME' => 'Dell Vostro 3557',
            'PRO_DESCRIPTION' => '15 pulgadas, 1TB HDD, 8GB RAM',
            'PRO_PRICE' => 1499.99,
            'PRO_IMG' => 'dell-v3557.png',
        ]);

        Producto::create([
            'PRO_NAME' => 'iPhone 11 Pro',
            'PRO_DESCRIPTION' => '6.1 pulgadas, 64GB 4GB RAM',
            'PRO_PRICE' => 649.99,
            'PRO_IMG' => 'iphone-11-pro.png',
        ]);

        Producto::create([
            'PRO_NAME' => 'Remax 610D Headset',
            'PRO_DESCRIPTION' => '6.1 pulgadas, 64GB 4GB RAM',
            'PRO_PRICE' => 8.99,
            'PRO_IMG' => 'remax-610d.jpg',
        ]);

        Producto::create([
            'PRO_NAME' => 'Samsung LED TV',
            'PRO_DESCRIPTION' => '24 pulgadas, LED Display, Resolución 1366 x 768',
            'PRO_PRICE' => 41.99,
            'PRO_IMG' => 'samsung-led-24.png',
        ]);
        Producto::create([
            'PRO_NAME' => 'Samsung Camara Digital',
            'PRO_DESCRIPTION' => '16.1MP, 5x Optical Zoom',
            'PRO_PRICE' => 144.99,
            'PRO_IMG' => 'samsung-mv800.jpg',
        ]);

        Producto::create([
            'PRO_NAME' => 'Huawei GR 5 2017',
            'PRO_DESCRIPTION' => '5.5 pulgadas, 32GB 4GB RAM',
            'PRO_PRICE' => 148.99,
            'PRO_IMG' => 'gr5-2017.jpg',
        ]);

    }
}
