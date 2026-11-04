<?php

test('api can list payments', function () {
    $response = $this->getJson('/api/payments');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data',
    ]);
});

test('api can create a payment', function () {
    $payload = [
        'name' => 'Bank Transfer',
    ];

    $response = $this->postJson('/api/payments', $payload);

    $response->assertStatus(201);
    $response->assertJsonPath('data.name', 'Bank Transfer');
});

test('api validates payment name on create', function () {
    $response = $this->postJson('/api/payments', []);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name']);
});
