<?php

use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("name", 50)->nullable(false);
            $table->string("surname", 50)->nullable(false);
            $table->enum("gender",
                [Student::GENDER_MALE, Student::GENDER_FEMALE])->nullable(false);
            $table->string("group", 5)->nullable(false);
            $table->integer("points", false, true)->nullable(false);
            $table->string("token", 60)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
