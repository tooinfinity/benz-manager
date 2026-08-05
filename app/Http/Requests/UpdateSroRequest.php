<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Sro;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateSroRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<int, mixed>|string>
     */
    public function rules(): array
    {
        $sro = $this->route('sro');
        assert($sro instanceof Sro);

        return [
            'service_order_id' => ['nullable', 'string', Rule::exists('service_orders', 'id')],
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Sro::class)->ignore($sro->id),
            ],
        ];
    }
}
