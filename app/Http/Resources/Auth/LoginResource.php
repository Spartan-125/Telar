<?php

namespace App\Http\Resources\Auth;

use App\Utils\ValuesDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this[ValuesDatabase::USER_COLUMN_ID],
            'name' => $this[ValuesDatabase::USER_COLUMN_NAME],
            'rol' => $this->rol[ValuesDatabase::ROL_COLUMN_NAME],
            'email' => $this[ValuesDatabase::USER_COLUMN_EMAIL],
            'token' => $this->token,
        ];
    }
}
