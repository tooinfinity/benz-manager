<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Zone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateZoneRequest extends FormRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', Rule::unique(Zone::class)],
            'code_odf' => ['nullable', 'string', 'max:255'],
            'olt_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'olt_longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }
}
