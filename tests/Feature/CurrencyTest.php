<?php

test('api can list currencies', function () {
    $response = $this->getJson('/api/currencies');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data',
    ]);
});

test('api can create a currency', function () {
    $payload = [
        'name' => 'Dirham',
        'short_name' => 'AED',
        'symbol' => 'د.إ',
    ];

    $response = $this->postJson('/api/currencies', $payload);

    $response->assertStatus(201);
    $response->assertJsonPath('data.name', 'Dirham');
    $response->assertJsonPath('data.short_name', 'AED');
    $response->assertJsonPath('data.symbol', 'د.إ');
});

test('api validates currency name on create', function () {
    $response = $this->postJson('/api/currencies', []);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name']);
});
