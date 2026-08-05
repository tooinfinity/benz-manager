<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Direction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateDirectionRequest extends FormRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique(Direction::class)],
        ];
    }
}
