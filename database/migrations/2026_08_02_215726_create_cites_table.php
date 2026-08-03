<?php

declare(strict_types=1);

use App\Models\Sro;
use App\Models\Zone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cites', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Zone::class);
            $table->foreignIdFor(Sro::class)->nullable();
            $table->string('code')->unique(); // C250-063-02
            $table->string('name');           // DAKSI DK B
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }
};
