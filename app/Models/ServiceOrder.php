<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\ServiceOrderFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read string $id
 * @property-read string $contract_id
 * @property-read string $zone_id
 * @property-read string $numero
 * @property int|null $nombre_logements
 * @property CarbonInterface|null $date_ouverture
 * @property CarbonInterface|null $date_reception
 * @property CarbonInterface|null $date_reversement
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Contract $contract
 * @property-read Zone $zone
 * @property-read Collection<int, Sro> $sros
 * @property-read Collection<int, ServiceOrderSignatory> $signatories
 */
final class ServiceOrder extends Model
{
    /** @use HasFactory<ServiceOrderFactory> */
    use HasFactory;

    use HasUuids;

    /**
     * @return BelongsTo<Contract, $this>
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * @return BelongsTo<Zone, $this>
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * @return HasMany<Sro, $this>
     */
    public function sros(): HasMany
    {
        return $this->hasMany(Sro::class);
    }

    /**
     * @return HasMany<ServiceOrderSignatory, $this>
     */
    public function signatories(): HasMany
    {
        return $this->hasMany(ServiceOrderSignatory::class);
    }

    /**
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'id' => 'string',
            'contract_id' => 'string',
            'zone_id' => 'string',
            'numero' => 'string',
            'nombre_logements' => 'string',
            'date_ouverture' => 'date',
            'date_reception' => 'date',
            'date_reversement' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
