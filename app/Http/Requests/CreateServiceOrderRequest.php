<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\ServiceOrder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateServiceOrderRequest extends FormRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'contract_id' => ['required', 'string', Rule::exists('contracts', 'id')],
            'zone_id' => ['required', 'string', Rule::exists('zones', 'id')],
            'numero' => ['required', 'string', 'max:255', Rule::unique(ServiceOrder::class)],
            'nombre_logements' => ['nullable', 'integer', 'min:0'],
            'date_ouverture' => ['nullable', 'date'],
            'date_reception' => ['nullable', 'date'],
            'date_reversement' => ['nullable', 'date'],
        ];
    }
}
