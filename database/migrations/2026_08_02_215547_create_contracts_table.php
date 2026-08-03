<?php

declare(strict_types=1);

use App\Models\Cmp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Cmp::class);
            $table->string('numero')->unique(); // 138/SDFS/DAL/SA/2023
            $table->string('intitule');
            $table->string('nature_travaux'); // enum-cast
            $table->string('technologie');    // enum-cast
            $table->timestamps();
        });
    }
};
