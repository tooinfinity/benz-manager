<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Direction;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateDirectionRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<int, mixed>|string>
     */
    public function rules(): array
    {
        $direction = $this->route('direction');
        assert($direction instanceof Direction);

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Direction::class)->ignore($direction->id),
            ],
        ];
    }
}
