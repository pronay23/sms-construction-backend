<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectInventory extends Model
{
    protected $fillable = [
        'project_id',
        'inventory_id',
        'detail',
        'date',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}
