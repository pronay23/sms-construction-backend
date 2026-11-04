<?php

test('api can list categories', function () {
    $response = $this->getJson('/api/categories');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data',
    ]);
});

test('api can create a category', function () {
    $payload = [
        'name' => 'Concrete & Masonry',
        'description' => 'Ready-mix concrete, hollow blocks, and sand.',
    ];

    $response = $this->postJson('/api/categories', $payload);

    $response->assertStatus(201);
    $response->assertJsonPath('data.name', 'Concrete & Masonry');
    $response->assertJsonPath('data.description', 'Ready-mix concrete, hollow blocks, and sand.');
});

test('api validates category name on create', function () {
    $response = $this->postJson('/api/categories', [
        'description' => 'Missing name',
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name']);
});
