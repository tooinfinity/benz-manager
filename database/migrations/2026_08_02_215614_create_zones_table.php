<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zones', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('code')->unique(); // Z250-063
            $table->string('code_odf')->nullable();
            $table->decimal('olt_latitude', 10, 7)->nullable();
            $table->decimal('olt_longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }
};
