<?php

namespace App\Models;

use Database\Factories\HomeFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'description',
    'location',
    'price',
    'bedrooms',
    'bathrooms',
    'area_sqft',
    'status',
    'image_url',
    'is_featured',
])]
class Home extends Model
{
    /** @use HasFactory<HomeFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'bedrooms' => 'integer',
            'bathrooms' => 'integer',
            'area_sqft' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Scope a query to only include featured homes.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function featured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by status.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    #[Scope]
    protected function ofStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }
}
