<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicofficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policofficers', function (Blueprint $table) {
        

            $table->id();
            $table->string('unitId')->nullable();
            $table->string('suspect_name')->nullable();
            $table->string('height_of_suspect')->nullable();
            $table->string('martic_number')->nullable();
            $table->string('weight_of_suspect')->nullable();
            $table->string('distinguinshing_features')->nullable();
            $table->string('nature_of_crime')->nullable();
            $table->string('number_of_offense')->nullable();
            $table->string('accomplices')->nullable();
            $table->string('motive')->nullable();
            $table->string('financial_benefits')->nullable();
            $table->string('environment_commited')->nullable();
            $table->string('enfd')->nullable();
            $table->string('cr')->nullable();
            $table->string('reg_officer_name')->nullable();
            $table->string('reg_signature_date')->nullable();
            $table->string('officer_name')->nullable();

            $table->string('officer_signature_date')->nullable();
            $table->string('oc_name')->nullable();
            $table->string('oc_signature_date')->nullable();

            $table->longText('note')->nullable();
            $table->longText('iponote')->nullable();
            $table->longText('ocnote')->nullable();
          
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
        Schema::dropIfExists('policofficers');
    }
}
