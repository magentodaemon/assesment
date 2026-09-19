<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'email_status' => $this->email_status,
            'company_name' => $this->company_name,
            'position_title' => $this->position_title,
            'position_location' => $this->position_location,
            'industry_name' => $this->industry_name,
            'location' => $this->location,
            'country_code' => $this->country_code,
            'persona' => $this->persona,
            'gender' => $this->gender,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}