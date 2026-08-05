<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Cmp;
use App\Models\Direction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateCmpRequest extends FormRequest
{
    /**
     * @return array<string, array<int, mixed>>
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
                Rule::unique(Cmp::class)
                    ->where('direction_id', $direction->id),
            ],
        ];
    }
}
