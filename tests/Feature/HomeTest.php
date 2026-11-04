<?php

test('home page returns a successful response with layout', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Construction Management Dashboard');
    $response->assertSee('BuildCore');
    $response->assertSee('Main Menu');
});

test('api can list homes', function () {
    $response = $this->getJson('/api/homes');

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data',
    ]);
});

test('api can create a home', function () {
    $homeData = [
        'title' => 'Oakwood Luxury Villa',
        'location' => 'Dallas, TX',
        'price' => 550000,
        'bedrooms' => 4,
        'bathrooms' => 3,
        'area_sqft' => 3200,
        'status' => 'under_construction',
        'description' => 'Custom architectural construction with premium finishings.',
    ];

    $response = $this->postJson('/api/homes', $homeData);

    $response->assertStatus(201);
    $response->assertJsonPath('data.title', 'Oakwood Luxury Villa');
    $response->assertJsonPath('data.status', 'under_construction');
});
