<?php

test('api can list employees', function () {
    $response = $this->getJson('/api/employees');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data',
    ]);
});

test('api can create an employee', function () {
    $payload = [
        'employee_id' => 'EMP003',
        'name' => 'Test Employee',
        'email' => 'test.employee@company.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $response = $this->postJson('/api/employees', $payload);

    $response->assertStatus(201);
    $response->assertJsonPath('data.employee_id', 'EMP003');
    $response->assertJsonPath('data.name', 'Test Employee');
    $response->assertJsonPath('data.email', 'test.employee@company.com');
});

test('api validates employee required fields on create', function () {
    $response = $this->postJson('/api/employees', []);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors([
        'employee_id',
        'name',
        'email',
        'password',
    ]);
});
