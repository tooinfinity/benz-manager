<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\ZoneFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read string $id
 * @property-read string $code
 * @property string|null $code_odf
 * @property float|null $olt_latitude
 * @property float|null $olt_longitude
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Collection<int, Sro> $sros
 * @property-read Collection<int, Cite> $cites
 * @property-read Collection<int, ServiceOrder> $serviceOrders
 */
final class Zone extends Model
{
    /** @use HasFactory<ZoneFactory> */
    use HasFactory;

    use HasUuids;

    /**
     * @return HasMany<Sro, $this>
     */
    public function sros(): HasMany
    {
        return $this->hasMany(Sro::class);
    }

    /**
     * @return HasMany<Cite, $this>
     */
    public function cites(): HasMany
    {
        return $this->hasMany(Cite::class);
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
            'code' => 'string',
            'code_odf' => 'string',
            'olt_latitude' => 'float',
            'olt_longitude' => 'float',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
