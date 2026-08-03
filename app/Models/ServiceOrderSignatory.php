<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SignatoryRole;
use Carbon\CarbonInterface;
use Database\Factories\ServiceOrderSignatoryFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read string $id
 * @property-read string $service_order_id
 * @property-read SignatoryRole $role
 * @property string|null $name
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read ServiceOrder $service_order
 */
final class ServiceOrderSignatory extends Model
{
    /** @use HasFactory<ServiceOrderSignatoryFactory> */
    use HasFactory;

    use HasUuids;

    /**
     * @return BelongsTo<ServiceOrder, $this>
     */
    public function serviceOrder(): BelongsTo
    {
        return $this->belongsTo(ServiceOrder::class);
    }

    /**
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'id' => 'string',
            'service_order_id' => 'string',
            'role' => SignatoryRole::class,
            'name' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
