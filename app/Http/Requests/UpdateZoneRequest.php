<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Zone;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateZoneRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<int, mixed>|string>
     */
    public function rules(): array
    {
        $zone = $this->route('zone');
        assert($zone instanceof Zone);

        return [
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Zone::class)->ignore($zone->id),
            ],
            'code_odf' => ['nullable', 'string', 'max:255'],
            'olt_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'olt_longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }
}
