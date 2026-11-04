<?php

test('api can list inventories', function () {
    $response = $this->getJson('/api/inventories');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data',
    ]);
});

test('api can create an inventory', function () {
    $payload = [
        'name' => 'Cement',
        'description' => 'Portland cement for structural concrete work.',
    ];

    $response = $this->postJson('/api/inventories', $payload);

    $response->assertStatus(201);
    $response->assertJsonPath('data.name', 'Cement');
    $response->assertJsonPath('data.description', 'Portland cement for structural concrete work.');
});

test('api validates inventory name on create', function () {
    $response = $this->postJson('/api/inventories', [
        'description' => 'Missing name',
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name']);
});
