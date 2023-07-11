<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuspectchild1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suspectchild1s', function (Blueprint $table) {
            $table->id();
            $table->Integer('martic_number')->nullable();
            $table->string('child1_name')->nullable();
            $table->string('child1_address')->nullable();
            $table->string('child1_birth')->nullable();
            $table->string('child1_phone')->nullable();
            $table->string('child1_res_address')->nullable();

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
        Schema::dropIfExists('suspectchild1s');
    }
}
