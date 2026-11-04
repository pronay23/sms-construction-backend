<?php

test('api can list expenses', function () {
    $response = $this->getJson('/api/expenses');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data',
    ]);
});

test('api can create an expense', function () {
    $payload = [
        'date' => '2026-11-01',
        'project_id' => 1,
        'category_id' => 1,
        'payment_id' => 1,
        'currency_id' => 1,
        'description' => 'Cement purchase for site work',
        'vendor_id' => 1,
        'amount' => 5000.00,
        'vat' => 5.00,
        'status' => 'paid',
    ];

    $response = $this->postJson('/api/expenses', $payload);

    $response->assertStatus(201);
    $response->assertJsonPath('data.amount', '5000.00');
    $response->assertJsonPath('data.status', 'paid');
});

test('api validates expense required fields on create', function () {
    $response = $this->postJson('/api/expenses', []);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['date', 'project_id', 'category_id', 'payment_id', 'currency_id', 'vendor_id', 'amount', 'status']);
});
