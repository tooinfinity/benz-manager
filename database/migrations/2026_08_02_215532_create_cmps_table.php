<?php

declare(strict_types=1);

use App\Models\Direction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cmps', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Direction::class);
            $table->string('name'); // SIDI MABROUK
            $table->timestamps();

            $table->unique(['direction_id', 'name']);
        });
    }
};
