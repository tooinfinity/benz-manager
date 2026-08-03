<?php

declare(strict_types=1);

use App\Models\ServiceOrder;
use App\Models\Zone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sros', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Zone::class);
            $table->foreignIdFor(ServiceOrder::class)->nullable();
            $table->string('code')->unique(); // C250-063-02-02
            $table->timestamps();
        });
    }
};
