<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Sro;
use App\Models\Zone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateSroRequest extends FormRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $zone = $this->route('zone');
        assert($zone instanceof Zone);

        return [
            'service_order_id' => ['nullable', 'string', Rule::exists('service_orders', 'id')],
            'code' => ['required', 'string', 'max:255', Rule::unique(Sro::class)],
        ];
    }
}
