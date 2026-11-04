<?php

test('api can list vendors', function () {
    $response = $this->getJson('/api/vendors');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data',
    ]);
});

test('api can create a vendor', function () {
    $payload = [
        'name' => 'Al Rashid Construction Supplies',
        'email' => 'contact@alrashid.com',
        'mobile_number' => '+971501234567',
        'address' => 'Al Qusais, Dubai, UAE',
    ];

    $response = $this->postJson('/api/vendors', $payload);

    $response->assertStatus(201);
    $response->assertJsonPath('data.name', 'Al Rashid Construction Supplies');
    $response->assertJsonPath('data.email', 'contact@alrashid.com');
});

test('api validates vendor required fields on create', function () {
    $response = $this->postJson('/api/vendors', []);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name', 'email', 'mobile_number']);
});
