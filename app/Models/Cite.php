<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\CiteFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read string $id
 * @property-read string $zone_id
 * @property-read string $sro_id
 * @property-read string $code
 * @property-read string $name
 * @property float|null $latitude
 * @property float|null $longitude
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read Zone $zone
 * @property-read Sro $sro
 */
final class Cite extends Model
{
    /** @use HasFactory<CiteFactory> */
    use HasFactory;

    use HasUuids;

    /**
     * @return BelongsTo<Zone, $this>
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * @return BelongsTo<Sro, $this>
     */
    public function sro(): BelongsTo
    {
        return $this->belongsTo(Sro::class);
    }

    /**
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'id' => 'string',
            'zone_id' => 'string',
            'sro_id' => 'string',
            'code' => 'string',
            'name' => 'string',
            'latitude' => 'float',
            'longitude' => 'float',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
