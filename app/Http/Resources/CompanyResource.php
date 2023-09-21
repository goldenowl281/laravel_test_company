<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name' => $this->name,
        ];
    }
    // public function with(Request $request)
    // {
    //     return [
    //         'vesion' => '1.0.0',
    //         'api_url'=> url('http://localhost:8000/api/companies/')
    //     ];
    // }
}
