<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

test("Customers should not be able to delete products", function () {
    // Add test product to the database
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);

    // Create a test customer
    $customer = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'user'
    ]);

    $this->actingAs($customer);

    // Customer attempt to delete the product
    $response = $this->delete(route('products.destroy', $product->slug));

    // Customer should be redirected to the home page
    $response->assertRedirect('/');

    // Check that the product was not deleted by the customer
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'test product',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);
});

test("Administrators should be able to delete products", function () {
    // Add test product to the database
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);

    // Create a test Administrator
    $admin = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'admin'
    ]);

    $this->actingAs($admin);

    // Administrator attempt to delete the product
    $response = $this->delete(route('products.destroy', $product->slug));

    // Administrators should be redirected to the admin dashboard
    $response->assertRedirect(route('admin.dashboard'));

    // Check that the product was deleted by the Administrator
    $this->assertDatabaseCount('products', 0);
});
