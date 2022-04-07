<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->index()->constrained()->onDelete('cascade');
            $table->tinyInteger('status')->default(2);
            $table->unsignedTinyInteger('order')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->json('devices');
            $table->unsignedTinyInteger('type');
            $table->tinyInteger('display');
            $table->unsignedSmallInteger('display_second')->nullable();
            $table->boolean('show_name')->default(false);
            $table->tinyInteger('limit')->default(1);
            $table->unsignedSmallInteger('limit_count')->nullable();
            $table->tinyInteger('trigger')->nullable();
            $table->unsignedSmallInteger('trigger_count')->nullable();
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
        Schema::dropIfExists('popups');
    }
}
