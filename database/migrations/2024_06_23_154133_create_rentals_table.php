<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('camera_id')->constrained('cameras')->onDelete('restrict');
            $table->foreignId('lens_id')->constrained('lenses')->onDelete('restrict');
            $table->date('tgl_sewa');
            $table->date('tgl_kembali');
            $table->decimal('total_harga', 10, 2);
            $table->string('jaminan', 255);
            $table->enum('status', ['pending', 'waiting', 'active', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
};