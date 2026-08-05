<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Cmp;
use App\Models\Direction;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateCmpRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<int, mixed>|string>
     */
    public function rules(): array
    {
        $direction = $this->route('direction');
        assert($direction instanceof Direction);

        $cmp = $this->route('cmp');
        assert($cmp instanceof Cmp);

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Cmp::class)
                    ->where('direction_id', $direction->id)
                    ->ignore($cmp->id),
            ],
        ];
    }
}
