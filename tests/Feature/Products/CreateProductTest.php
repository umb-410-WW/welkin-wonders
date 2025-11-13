<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test("Customers should not be able to create/store products", function () {
    // Create a test customer
    $customer = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'user'
    ]);

    $this->actingAs($customer);

    // Attempt to access the store products route
    $response = $this->post(route('products.store'), [
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => false
    ]);

    // Customer should be redirected to the home page
    $response->assertRedirect('/');

    // Assert that the customer did not add the product
    $this->assertDatabaseCount('products', 0);
});

test("Administrators should be able to create products", function () {
    // Create a test Administrator
    $admin = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'admin'
    ]);

    $this->actingAs($admin);

    // Store a test product
    $response = $this->post(route('products.store'), [
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => false
    ]);

    // Admin should be redirected back to admin dashboard
    $response->assertRedirect(route('admin.dashboard'));

    // Assert that the product was added to the database
    $this->assertDatabaseHas('products', [
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => false
    ]);
});

test("Administrators should not be able to create products with invalid attribute values", function () {
    // Create a test Administrator
    $admin = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'admin'
    ]);

    $this->actingAs($admin);

    // Attempt to store an invalid product
    $response = $this->post(route('products.store'), [
        'name' => 9876,
        'slug' => 23,
        'description' => 500,
        'price' => 'this is a string',
        'stock_quantity' => 'three',
        'is_active' => 'hello'
    ]);

    // Assert that there were some errors adding the products
    $response->assertSessionHasErrors([
        'name',
        'slug',
        'description',
        'price',
        'stock_quantity',
        'is_active'
    ]);

    // Assert that the product was not added to the database
    $this->assertDatabaseCount('products', 0);
});
