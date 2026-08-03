<?php

declare(strict_types=1);

use App\Models\Contract;
use App\Models\Zone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_orders', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Contract::class);
            $table->foreignIdFor(Zone::class);
            $table->string('numero')->unique(); // AT/DOT/N°143/SDTO/DRA/RU-ODN/2024
            $table->unsignedInteger('nombre_logements')->nullable();
            $table->date('date_ouverture')->nullable();
            $table->date('date_reception')->nullable();
            $table->date('date_reversement')->nullable();
            $table->timestamps();
        });
    }
};
