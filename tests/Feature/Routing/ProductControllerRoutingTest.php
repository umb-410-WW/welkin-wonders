<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

test("Customers/Guests should be able to see individual product pages (that are active)", function () {
    // Add test product to the database
    $product = Product::factory()->create([
       'name' => 'test product',
       'slug' => 'test-product',
       'description' => 'test product description',
       'price' => 5.99,
       'stock_quantity' => 3,
       'is_active' => true
    ]);

    // Go to the product's page
    $response = $this->get('/products/' . $product->slug);

    // The customer should successfully go to the page
    $response->assertStatus(200);
});

test("Customers/Guests should not be able to see inactive individual product pages", function () {
    // Add test product to the database
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => false
    ]);

    // Go to the product's page
    $response = $this->get('/products/' . $product->slug);

    // The customer should be redirected to the home page
    $response->assertRedirect('/');
});

test("Customers should not be able to access the create product route", function () {
    // Create a test customer
    $customer = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'user'
    ]);

    $this->actingAs($customer);

    // Attempt to access the create product page
    $response = $this->get('/products/create');

    // Customer should be redirected to the home page
    $response->assertRedirect('/');
});

test("Customers should not be able to access the store product route", function () {
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

test("Customers should not be able to access the edit product route", function () {
    // Add test product to the database
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => false
    ]);

    // Create a test customer
    $customer = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'user'
    ]);

    $this->actingAs($customer);

    // Attempt to access the edit product page
    $response = $this->get('/products/' . $product->slug . '/edit');
    $response->assertRedirect('/');
});

test("Customers should not be able to access the update product route", function () {
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

    // Customer should be redirected to the home page
    $response->assertRedirect('/');

    // Check that the product was not updated by the customer
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'test product',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);
});

test("Customers should not be able to access the destroy product route", function () {
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

test("Administrators should be routed to the admin.products.create page via the create route", function () {
    // Create a test Administrator
    $admin = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'admin'
    ]);

    $this->actingAs($admin);

    // Attempt to access the create product page
    $response = $this->get(route('products.create'));

    // Assert that the request for the create product page was successful
    $response->assertStatus(200);
});

test("Administrators should be routed to the admin.products.edit page via the edit route", function () {
    // Add test product to the database
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => false
    ]);

    // Create a test Administrator
    $admin = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'admin'
    ]);

    $this->actingAs($admin);

    // Attempt to access the edit product page
    $response = $this->get('/products/' . $product->slug . '/edit');

    // Assert that the requested edit product page was succesful
    $response->assertStatus(200);
});

test("Administrators should be able to use the products.store route", function () {
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

test("Administrators should be able to use the products.update route", function () {
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

test("Administrators should be able to use the products.destroy route", function () {
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

