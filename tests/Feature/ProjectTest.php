<?php

test('api can list projects', function () {
    $response = $this->getJson('/api/projects');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data',
    ]);
});

test('api can create a project', function () {
    $payload = [
        'name' => 'Metro Bridge Expansion',
        'description' => 'Infrastructure civil engineering and foundation work.',
    ];

    $response = $this->postJson('/api/projects', $payload);

    $response->assertStatus(201);
    $response->assertJsonPath('data.name', 'Metro Bridge Expansion');
    $response->assertJsonPath('data.description', 'Infrastructure civil engineering and foundation work.');
});

test('api validates project name on create', function () {
    $response = $this->postJson('/api/projects', [
        'description' => 'Missing project name',
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name']);
});
