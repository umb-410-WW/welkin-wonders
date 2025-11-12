<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\actingAs;

test("Customers should automatically be routed to the about page on login", function () {
    $customer = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'user'
    ]);

    $response = $this->post('/login', [
        'email' => $customer->email,
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('about'));
});

test("Customers should automatically be routed to the about page on register", function () {
    $response = $this->post('/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]);

    $response->assertRedirect(route('about'));
});

test("Administrators should automatically be routed to the admin dashboard on login", function () {
    $admin = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'admin'
    ]);

    $response = $this->post('/login', [
        'email' => $admin->email,
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
});

test("Administrators should be able to access the admin dashboard", function () {
    $admin = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'admin'
    ]);

    $this->actingAs($admin);

    $response = $this->get('/admin/dashboard');

    $response->assertStatus(200);
});

test("Customers should just be rerouted to the home page if they attempt to access admin dashboard", function () {
    $customer = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'johndoe@email.com',
        'password' => Hash::make('password123'),
        'user_type' => 'user'
    ]);

    $this->actingAs($customer);

    $response = $this->get('/admin/dashboard');

    $response->assertRedirect('/');
});

test("Guests should just be rerouted to the login page if they attempt to access admin dashboard", function () {
    $response = $this->get('/admin/dashboard');

    $response->assertRedirect(route('login'));
});

test("The about route should bring the user to the About page", function () {
    $response = $this->get('/about');
    $response->assertViewIs('about');
});

test("The contact route should bring the user to the Contact page", function () {
    $response = $this->get('/contact');
    $response->assertViewIs('contact');
});

test("The readings route should bring the user to the Readings page", function () {
    $response = $this->get('/readings');
    $response->assertViewIs('readings');
});

test("The shop route should bring the user to the Shop page", function () {
    $response = $this->get('/shop');
    $response->assertViewIs('shop');
});
