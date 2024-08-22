<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artikel_id')->constrained()->onDelete('cascade');
            $table->string('tgl_issue');
            $table->string('tgl_selesai')->nullable();
            $table->string('gambar');
            $table->string('deskripsi');
            $table->string('status')->enum ('Diproses', 'Diterima', 'Diperbaiki', 'Selesai')->default('Dikirim');
            $table->string('estimasi')->nullable();
            $table->string('catatan')->nullable();
            $table->boolean('is_done')->default(false);
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
        Schema::dropIfExists('issue');
    }
}
