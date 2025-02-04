<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carousels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('desktop_image');
            $table->string('tablet_image');
            $table->string('mobile_image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carousels');
    }
};
