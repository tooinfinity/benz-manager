<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\NatureTravaux;
use App\Enums\Technologie;
use App\Models\Contract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateContractRequest extends FormRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'cmp_id' => ['required', 'string', Rule::exists('cmps', 'id')],
            'numero' => ['required', 'string', 'max:255', Rule::unique(Contract::class)],
            'intitule' => ['required', 'string', 'max:255'],
            'nature_travaux' => ['required', 'string', Rule::enum(NatureTravaux::class)],
            'technologie' => ['required', 'string', Rule::enum(Technologie::class)],
        ];
    }
}
