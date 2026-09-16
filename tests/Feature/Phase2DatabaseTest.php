<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ShippingRate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class Phase2DatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_required_tables_exist(): void
    {
        $tables = [
            'users',
            'categories',
            'products',
            'product_images',
            'shipping_rates',
            'orders',
            'order_items',
        ];

        foreach ($tables as $table) {
            $this->assertTrue(
                Schema::hasTable($table),
                "Table {$table} tidak ditemukan."
            );
        }
    }

    public function test_category_has_products(): void
    {
        $category = Category::create([
            'name' => 'Plush',
            'slug' => 'plush',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Levi Ackerman Plush',
            'slug' => 'levi-ackerman-plush',
            'description' => 'Anime plush',
            'price' => 150000,
            'stock' => 10,
            'reserved_stock' => 0,
        ]);

        $this->assertTrue($category->products->contains($product));
    }

    public function test_product_has_multiple_images(): void
    {
        $category = Category::create([
            'name' => 'Plush',
            'slug' => 'plush',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Levi Plush',
            'slug' => 'levi-plush',
            'price' => 150000,
            'stock' => 10,
            'reserved_stock' => 0,
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => 'products/levi-1.jpg',
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => 'products/levi-2.jpg',
        ]);

        $this->assertCount(2, $product->images);
    }

    public function test_available_stock_is_stock_minus_reserved_stock(): void
    {
        $category = Category::create([
            'name' => 'Plush',
            'slug' => 'plush',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Stock Test Product',
            'slug' => 'stock-test-product',
            'price' => 100000,
            'stock' => 10,
            'reserved_stock' => 3,
        ]);

        $this->assertEquals(7, $product->available_stock);
    }

    public function test_user_has_orders(): void
    {
        $user = User::factory()->create();

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-TEST-001',
            'total_amount' => 150000,
            'shipping_cost' => 15000,
            'shipping_address' => 'Alamat Test',
            'shipping_city' => 'Boyolali',
            'shipping_district' => 'Boyolali',
            'shipping_postal_code' => '57311',
            'payment_method' => 'QRIS',
            'payment_status' => 'PENDING',
            'order_status' => 'PENDING',
        ]);

        $this->assertTrue($user->orders->contains($order));
    }

    public function test_order_has_order_items(): void
    {
        $user = User::factory()->create();

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-TEST-002',
            'total_amount' => 150000,
            'shipping_cost' => 15000,
            'shipping_address' => 'Alamat Test',
            'shipping_city' => 'Boyolali',
            'shipping_district' => 'Boyolali',
            'shipping_postal_code' => '57311',
            'payment_method' => 'QRIS',
            'payment_status' => 'PENDING',
            'order_status' => 'PENDING',
        ]);

        $item = OrderItem::create([
            'order_id' => $order->id,
            'product_id' => null,
            'product_name' => 'Test Product',
            'quantity' => 2,
            'price' => 50000,
            'subtotal' => 100000,
            'variation_note' => 'Black',
        ]);

        $this->assertTrue($order->orderItems->contains($item));
    }

    public function test_shipping_rate_can_be_created(): void
    {
        $rate = ShippingRate::create([
            'courier' => 'JNE',
            'city' => 'Boyolali',
            'cost' => 15000,
        ]);

        $this->assertDatabaseHas('shipping_rates', [
            'courier' => 'JNE',
            'city' => 'Boyolali',
            'cost' => 15000,
        ]);
    }
}