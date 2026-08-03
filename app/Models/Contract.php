<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\NatureTravaux;
use App\Enums\Technologie;
use Carbon\CarbonInterface;
use Database\Factories\ContractFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read string $id
 * @property-read string $cmp_id
 * @property-read string $numero
 * @property-read string $intitule
 * @property NatureTravaux $nature_travaux
 * @property Technologie $technologie
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Cmp $cmp
 * @property-read Collection<int, ServiceOrder> $serviceOrders
 */
final class Contract extends Model
{
    /** @use HasFactory<ContractFactory> */
    use HasFactory;

    use HasUuids;

    /**
     * @return BelongsTo<Cmp, $this>
     */
    public function cmp(): BelongsTo
    {
        return $this->belongsTo(Cmp::class);
    }

    /**
     * @return HasMany<ServiceOrder, $this>
     */
    public function serviceOrders(): HasMany
    {
        return $this->hasMany(ServiceOrder::class);
    }

    /**
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'id' => 'string',
            'cmp_id' => 'string',
            'numero' => 'string',
            'intitule' => 'string',
            'nature_travaux' => NatureTravaux::class,
            'technologie' => Technologie::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
