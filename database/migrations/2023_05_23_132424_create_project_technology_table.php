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
        Schema::create('project_technology', function (Blueprint $table) {
            // $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('technology_id')->constrained()->cascadeOnDelete();

            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('technology_id');

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('technology_id')->references('id')->on('technologies');

            $table->primary(['project_id','technology_id']);
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
        Schema::dropIfExists('project_technology');
    }
};
