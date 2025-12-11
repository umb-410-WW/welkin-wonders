<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

test("Customers should not be able to update products", function () {
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

    // Customer attempt to update the product
    $response = $this->put(route('products.update', $product->slug), [
        'name' => 'Updated name'
    ]);

    // Check that the product was not updated by the customer
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'test product',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);
});

test("Administrators should be able to update products", function () {
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

    // Administrator attempt to update the product
    $response = $this->put(route('products.update', $product->slug), [
        'name' => 'Updated name'
    ]);

    // Administrator should be redirected to the admin dashboard after updating
    $response->assertRedirect(route('admin.dashboard'));

    // Check that the product was updated by the Administrator
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Updated name',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);
});

test("An error should be thrown when an Administrator enters an improper value during product update", function () {
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

    // Administrator attempt to update the product with invalid values
    $response = $this->put(route('products.update', $product->slug), [
        'stock_quantity' => 'three'
    ]);

    // Assert that there were errors updating the product with the invalid values
    $response->assertSessionHasErrors([
        'stock_quantity'
    ]);

    // Check that the product was not updated by the Administrator
    $this->assertDatabaseHas('products', [
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);
});
