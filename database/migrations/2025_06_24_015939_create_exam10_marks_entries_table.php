<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExam10MarksEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam10_marks_entries', function (Blueprint $table) {
            $table->id();$table->string('name');
            $table->string('description')->nullable();
            
            $table->integer('exam_detail_id')->unsigned()->nullable();
            $table->integer('exam_class_subject_id')->unsigned()->nullable();
                        
            $table->decimal('exam_marks', 8, 2)->unsigned()->nullable();
                       
            $table->integer('session_id')->unsigned()->nullable();
            $table->integer('school_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('approved_by')->unsigned()->nullable();
            $table->boolean('is_active')->default(1)->nullable();
            $table->boolean('is_finalized')->default(0)->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();

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
        Schema::dropIfExists('exam10_marks_entries');
    }
}
