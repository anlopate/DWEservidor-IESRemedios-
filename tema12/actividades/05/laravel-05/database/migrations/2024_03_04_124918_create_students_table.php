<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // name varchar (35)
            $table->string('name', 35);
            $table->string('surname', 45);
            $table->date('birth_date');
            $table->char('phone',13)->unique()->nullable(false);
            $table->string('city',20);
            $table->char('dni', 9)->unique()->nullable(false);
            $table->string('email', 40)->unique();
            $table->unsignedBigInteger('course_id');
            $table->timestamps();

            // Restricción
            $table->foreign('course_id')->references('id')->on('courses')->Ondelete('restrict')->OnUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     * Deshacer.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
