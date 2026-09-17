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
            // Plush
            [
                'category' => 'Plush',
                'name' => 'Plush Gojo Satoru',
                'price' => 25000,
                'stock' => 10,
                'image' => 'products/gojo-plush.jpg',
            ],
            [
                'category' => 'Plush',
                'name' => 'Plush Tanjiro',
                'price' => 25000,
                'stock' => 10,
                'image' => 'products/tanjiro-plush.jpg',
            ],
            [
                'category' => 'Plush',
                'name' => 'Plush Umaru-chan',
                'price' => 25000,
                'stock' => 10,
                'image' => 'products/umaru-plush.jpg',
            ],

            // Keychain
            [
                'category' => 'Keychain',
                'name' => 'Anya Keychain',
                'price' => 15000,
                'stock' => 20,
                'image' => 'products/anya-keychain.jpg',
            ],
            [
                'category' => 'Keychain',
                'name' => 'Elaina Keychain',
                'price' => 15000,
                'stock' => 20,
                'image' => 'products/elaina-keychain.jpg',
            ],
            [
                'category' => 'Keychain',
                'name' => 'Luffy Keychain',
                'price' => 15000,
                'stock' => 20,
                'image' => 'products/luffy-keychain.jpg',
            ],

            // Poster
            [
                'category' => 'Poster',
                'name' => 'One Piece Poster',
                'price' => 10000,
                'stock' => 15,
                'image' => 'products/one-piece-poster.jpg',
            ],
            [
                'category' => 'Poster',
                'name' => 'Frieren Poster',
                'price' => 10000,
                'stock' => 15,
                'image' => 'products/frieren-poster.jpg',
            ],
            [
                'category' => 'Poster',
                'name' => 'Jujutsu Kaisen Poster',
                'price' => 10000,
                'stock' => 15,
                'image' => 'products/jjk-poster.jpg',
            ],

            // Card Accessories
            [
                'category' => 'Card Accessories',
                'name' => 'Hatsune Miku Hologram Card',
                'price' => 12000,
                'stock' => 25,
                'image' => 'products/miku-hologram-card.jpg',
            ],
            [
                'category' => 'Card Accessories',
                'name' => 'Kafka Hologram Card',
                'price' => 12000,
                'stock' => 25,
                'image' => 'products/kafka-hologram-card.jpg',
            ],
            [
                'category' => 'Card Accessories',
                'name' => 'Furina Hologram Card',
                'price' => 12000,
                'stock' => 25,
                'image' => 'products/furina-hologram-card.jpg',
            ],

            // Pin
            [
                'category' => 'Pin',
                'name' => 'Nailong Pin',
                'price' => 6000,
                'stock' => 30,
                'image' => 'products/nailong-pin.jpg',
            ],
            [
                'category' => 'Pin',
                'name' => 'Zenitsu Pin',
                'price' => 6000,
                'stock' => 30,
                'image' => 'products/zenitsu-pin.jpg',
            ],
            [
                'category' => 'Pin',
                'name' => 'Shinobu Pin',
                'price' => 6000,
                'stock' => 30,
                'image' => 'products/shinobu-pin.jpg',
            ],

            // Uchiwa Fan
            [
                'category' => 'Uchiwa Fan',
                'name' => 'Muichiro Uchiwa Fan',
                'price' => 10000,
                'stock' => 12,
                'image' => 'products/muichiro-uchiwa.jpg',
            ],
            [
                'category' => 'Uchiwa Fan',
                'name' => 'Gojo Uchiwa Fan',
                'price' => 10000,
                'stock' => 12,
                'image' => 'products/gojo-uchiwa.jpg',
            ],
            [
                'category' => 'Uchiwa Fan',
                'name' => 'Tanjiro Uchiwa Fan',
                'price' => 10000,
                'stock' => 12,
                'image' => 'products/tanjiro-uchiwa.jpg',
            ],

            // K-Pop
            [
                'category' => 'K-Pop',
                'name' => 'BLACKPINK A',
                'price' => 15000,
                'stock' => 20,
                'image' => 'products/blackpink-a.jpg',
            ],
            [
                'category' => 'K-Pop',
                'name' => 'aespa A',
                'price' => 15000,
                'stock' => 20,
                'image' => 'products/aespa-a.jpg',
            ],
            [
                'category' => 'K-Pop',
                'name' => 'BOYNEXTDOOR A',
                'price' => 15000,
                'stock' => 20,
                'image' => 'products/boynextdoor-a.jpg',
            ],

            // Tote Bag
            [
                'category' => 'Tote Bag',
                'name' => 'One Piece Tote Bag',
                'price' => 15000,
                'stock' => 10,
                'image' => 'products/one-piece-tote-bag.jpg',
            ],
            [
                'category' => 'Tote Bag',
                'name' => 'Gojo Tote Bag',
                'price' => 15000,
                'stock' => 10,
                'image' => 'products/gojo-tote-bag.jpg',
            ],
            [
                'category' => 'Tote Bag',
                'name' => 'Cute Girl Tote Bag',
                'price' => 15000,
                'stock' => 10,
                'image' => 'products/cute-girl-tote-bag.jpg',
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->firstOrFail();

            $product = Product::updateOrCreate(
                [
                    'slug' => Str::slug($item['name']),
                ],
                [
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'description' => $item['name'] . ' untuk koleksi merchandise Anireshop.',
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                ]
            );

            ProductImage::firstOrCreate([
                'product_id' => $product->id,
                'image_path' => $item['image'],
            ]);
        }
    }
}