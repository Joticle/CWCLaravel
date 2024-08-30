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
        Schema::table('course_syllabus', function (Blueprint $table) {
            $table->string('name')->after('course_id');
            $table->integer('sort_order')->default('1')->after('file');
            $table->enum('status', ['0', '1'])->default('1')->after('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_syllabus', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('sort_order');
            $table->dropColumn('status');
        });
    }
};
