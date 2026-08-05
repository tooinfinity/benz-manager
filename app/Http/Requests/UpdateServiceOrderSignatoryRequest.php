<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\SignatoryRole;
use App\Models\ServiceOrderSignatory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateServiceOrderSignatoryRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<int, mixed>|string>
     */
    public function rules(): array
    {
        $signatory = $this->route('signatory');
        assert($signatory instanceof ServiceOrderSignatory);

        return [
            'role' => [
                'required',
                'string',
                Rule::enum(SignatoryRole::class),
            ],
            'name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
