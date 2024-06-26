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
        Schema::create('students_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('image')->nullable();
            $table->text('text');
            $table->tinyInteger('rating')->default(0);
            $table->enum('status', ['0', '1'])->default('1');
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
        Schema::dropIfExists('students_feedback');
    }
};
