<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\SignatoryRole;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderSignatory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateServiceOrderSignatoryRequest extends FormRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $serviceOrder = $this->route('serviceOrder');
        assert($serviceOrder instanceof ServiceOrder);

        return [
            'role' => [
                'required',
                'string',
                Rule::enum(SignatoryRole::class),
                Rule::unique(ServiceOrderSignatory::class)
                    ->where('service_order_id', $serviceOrder->id),
            ],
            'name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
