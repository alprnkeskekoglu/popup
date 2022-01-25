<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('popup_id')->index()->constrained()->onDelete('cascade');
            $table->unsignedInteger('language_id')->index();
            $table->boolean('status')->default(1);
            $table->string('name')->nullable();
            $table->text('detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popup_translations');
    }
}
