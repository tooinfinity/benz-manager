<?php

declare(strict_types=1);

use App\Models\ServiceOrder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_order_signatories', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignIdFor(ServiceOrder::class);
            $table->string('role'); // enum-cast: SignatoryRole
            $table->string('name')->nullable();
            $table->timestamps();

            $table->unique(['service_order_id', 'role']);
        });
    }
};
