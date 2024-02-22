<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'status' => $this->status,
            'assigned_date' => $this->assigned_date,
            'due_date' => $this->due_date,
            'completed_date' => $this->completed_date,
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
