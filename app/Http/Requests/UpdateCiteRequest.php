<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Cite;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateCiteRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<int, mixed>|string>
     */
    public function rules(): array
    {
        $cite = $this->route('cite');
        assert($cite instanceof Cite);

        return [
            'sro_id' => ['nullable', 'string', Rule::exists('sros', 'id')],
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Cite::class)->ignore($cite->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }
}
