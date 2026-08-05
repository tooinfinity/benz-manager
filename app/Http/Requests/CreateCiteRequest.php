<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Cite;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateCiteRequest extends FormRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'sro_id' => ['nullable', 'string', Rule::exists('sros', 'id')],
            'code' => ['required', 'string', 'max:255', Rule::unique(Cite::class)],
            'name' => ['required', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }
}
