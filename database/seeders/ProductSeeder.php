<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'category' => 'Plush',
                'name' => 'Levi Ackerman Plush',
                'description' => 'Plush karakter anime dengan ukuran dan variasi sesuai deskripsi produk.',
                'price' => 150000,
                'stock' => 10,
                'images' => [
                    'products/levi-plush-1.jpg',
                    'products/levi-plush-2.jpg',
                ],
            ],
            [
                'category' => 'Keychain',
                'name' => 'One Piece Acrylic Keychain',
                'description' => 'Acrylic keychain bertema One Piece.',
                'price' => 35000,
                'stock' => 20,
                'images' => [
                    'products/one-piece-keychain.jpg',
                ],
            ],
            [
                'category' => 'Poster',
                'name' => 'Anime Wall Poster',
                'description' => 'Poster anime untuk dekorasi kamar.',
                'price' => 45000,
                'stock' => 15,
                'images' => [
                    'products/anime-poster.jpg',
                ],
            ],
            [
                'category' => 'Card Accessories',
                'name' => 'Photocard Holder',
                'description' => 'Holder untuk menyimpan dan melindungi photocard.',
                'price' => 25000,
                'stock' => 25,
                'images' => [
                    'products/photocard-holder.jpg',
                ],
            ],
            [
                'category' => 'Pin',
                'name' => 'Anime Character Pin',
                'description' => 'Pin karakter anime untuk koleksi dan dekorasi.',
                'price' => 15000,
                'stock' => 30,
                'images' => [
                    'products/anime-pin.jpg',
                ],
            ],
            [
                'category' => 'Uchiwa Fan',
                'name' => 'K-Pop Uchiwa Fan',
                'description' => 'Uchiwa fan untuk koleksi K-Pop.',
                'price' => 50000,
                'stock' => 12,
                'images' => [
                    'products/kpop-uchiwa.jpg',
                ],
            ],
            [
                'category' => 'K-Pop',
                'name' => 'K-Pop Photocard',
                'description' => 'Photocard K-Pop untuk koleksi.',
                'price' => 30000,
                'stock' => 20,
                'images' => [
                    'products/kpop-photocard.jpg',
                ],
            ],
            [
                'category' => 'Tote Bag',
                'name' => 'Anime Canvas Tote Bag',
                'description' => 'Tote bag canvas dengan desain anime.',
                'price' => 85000,
                'stock' => 10,
                'images' => [
                    'products/anime-tote-bag.jpg',
                ],
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->firstOrFail();

            $product = Product::create([
                'category_id' => $category->id,
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['description'],
                'price' => $item['price'],
                'stock' => $item['stock'],
                'reserved_stock' => 0,
            ]);

            foreach ($item['images'] as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $image,
                ]);
            }
        }
    }
}