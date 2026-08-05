<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\ServiceOrder;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateServiceOrderRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<int, mixed>|string>
     */
    public function rules(): array
    {
        $serviceOrder = $this->route('serviceOrder');
        assert($serviceOrder instanceof ServiceOrder);

        return [
            'contract_id' => ['required', 'string', Rule::exists('contracts', 'id')],
            'zone_id' => ['required', 'string', Rule::exists('zones', 'id')],
            'numero' => [
                'required',
                'string',
                'max:255',
                Rule::unique(ServiceOrder::class)->ignore($serviceOrder->id),
            ],
            'nombre_logements' => ['nullable', 'integer', 'min:0'],
            'date_ouverture' => ['nullable', 'date'],
            'date_reception' => ['nullable', 'date'],
            'date_reversement' => ['nullable', 'date'],
        ];
    }
}
