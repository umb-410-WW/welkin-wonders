<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

test("Customers/Guests should be able to see individual product pages (that are active)", function () {
    $product = Product::factory()->create([
       'name' => 'test product',
       'slug' => 'test-product',
       'description' => 'test product description',
       'price' => 5.99,
       'stock_quantity' => 3,
       'is_active' => true
    ]);
    $response = $this->get('/products/' . $product->slug);

    $response->assertStatus(200);
});

test("Customers/Guests should not be able to see inactive individual product pages", function () {
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => false
    ]);
    $response = $this->get('/products/' . $product->slug);

    $response->assertRedirect('/');
});

test("Customers should not be able to access the create product route", function () {
    $customer = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'user'
    ]);

    $this->actingAs($customer);

    $response = $this->get('/products/create');
    $response->assertRedirect('/');
});

test("Customers should not be able to access the store product route", function () {
    $customer = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'user'
    ]);

    $this->actingAs($customer);

    $response = $this->post(route('products.store'));
    $response->assertRedirect('/');
});

test("Customers should not be able to access the edit product route", function () {
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => false
    ]);

    $customer = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'user'
    ]);

    $this->actingAs($customer);

    $response = $this->get('/products/' . $product->slug . '/edit');
    $response->assertRedirect('/');
});

test("Customers should not be able to access the update product route", function () {
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);

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
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);

    $customer = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'user'
    ]);

    $this->actingAs($customer);

    // Customer attempt to delete the product
    $response = $this->delete(route('products.destroy', $product->slug));

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
    $admin = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'admin'
    ]);

    $this->actingAs($admin);

    $response = $this->get(route('products.create'));
    $response->assertStatus(200);
});

test("Administrators should be routed to the admin.products.edit page via the edit route", function () {
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => false
    ]);

    $admin = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'admin'
    ]);

    $this->actingAs($admin);

    $response = $this->get('/products/' . $product->slug . '/edit');
    $response->assertStatus(200);
});

test("Administrators should be able to use the products.store route", function () {
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
});

test("Administrators should be able to use the products.update route", function () {
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);

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
    $product = Product::factory()->create([
        'name' => 'test product',
        'slug' => 'test-product',
        'description' => 'test product description',
        'price' => 5.99,
        'stock_quantity' => 3,
        'is_active' => true
    ]);

    $admin = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'admin'
    ]);

    $this->actingAs($admin);

    // Customer attempt to delete the product
    $response = $this->delete(route('products.destroy', $product->slug));

    $response->assertRedirect(route('admin.dashboard'));

    // Check that the product was deleted by the Administrator
    $this->assertDatabaseCount('products', 0);
});

