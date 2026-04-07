<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'name' => $this->name,
            'students' => StudentResource::make($this->whenLoaded('students')),
            'programmes' => ProgrammeResource::make($this->whenLoaded('programmes')),
            'staffs' => StaffResource::make($this->whenLoaded('staffs'))
        ];
    }
}
