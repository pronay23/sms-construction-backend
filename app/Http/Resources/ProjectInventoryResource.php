<?php

namespace App\Http\Resources;

use App\Models\ProjectInventory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ProjectInventory
 */
class ProjectInventoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'inventory_id' => $this->inventory_id,
            'detail' => $this->detail,
            'date' => $this->date?->format('Y-m-d'),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
