<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupectInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supect_infos', function (Blueprint $table) {
            $table->id();

            $table->string('unitId');

            $table->string('fringer')->longText()->nullable();
            $table->integer('martic_number')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();

            $table->longText('note')->nullable();
            $table->string('middlename')->nullable();
            $table->string('affix_left')->nullable();
            $table->string('affix_right')->nullable();
            $table->string('affix_front')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_birth')->nullable();
            $table->string('place_birth')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('langugaes')->nullable();
            $table->string('residental_address')->nullable();
            $table->string('international_passport')->nullable();
            $table->string('office_shop')->nullable();

            $table->string('tertiary_i')->nullable();
            $table->string('tertiary_y')->nullable();
            $table->string('tertiary_yg')->nullable();
            $table->string('secondary')->nullable();
            $table->string('s_year_of_entry')->nullable();
            $table->string('s_year_of_gradution')->nullable();
            $table->string('p_year')->nullable();
            $table->string('p_year_g')->nullable();
            $table->string('primary')->nullable();


            $table->string('last_place')->nullable();
            $table->string('address_employer')->nullable();
            $table->string('Penultimate_Place')->nullable();
            $table->string('address_of_penultimate')->nullable();

            $table->string('nationality')->nullable();
            $table->string('state')->nullable();
            $table->string('ethnic_group')->nullable();
            $table->string('local_govt')->nullable();
            $table->string('town_village')->nullable();


            $table->string('spouse_name')->nullable();
            $table->string('spouse_maiden')->nullable();
            $table->string('spouse_date_brith')->nullable();
            $table->string('spouse_residential_address')->nullable();
            $table->string('spouse_phone')->nullable();
            $table->string('spouse_work')->nullable();


            $table->string('father_name')->nullable();
            // $table->string('father_address')->nullable();
            $table->string('father_birth')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('father_res_address')->nullable();


            $table->string('mother_name')->nullable();
            // $table->string('mother_address')->nullable();
            $table->string('mother_birth')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('mother_res_address')->nullable();


            $table->string('Sibling1_name')->nullable();

            $table->string('Sibling1_birth')->nullable();
            $table->string('Sibling1_phone')->nullable();
            $table->string('Sibling1_res_address')->nullable();

            // $table->foreignId('user_id')->constrained('suspectinfomations');
            $table->string('Sibling2_name')->nullable();

            $table->string('Sibling2_birth')->nullable();
            $table->string('Sibling2_phone')->nullable();
            $table->string('Sibling2_res_address')->nullable();

            $table->string('Landlord_name')->nullable();
            $table->string('Landlord_address')->nullable();

            $table->string('Landlord_phone')->nullable();
            // $table->foreignId('user_id')->constrained('suspectinfomations');
            $table->string('hereby_name')->nullable();
            $table->string('hereby_signature')->nullable();


            $table->timestamps();
        });
        Schema::create('surety_infos', function (Blueprint $table) {
            $table->id();
            $table->string('unitId')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('supect_infos')->onDelete('cascade');
            $table->string('martic_number')->nullable();

            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('middlename')->nullable();

            $table->string('fringer')->nullable();

            $table->string('affix_left')->nullable();
            $table->string('affix_front')->nullable();
            $table->string('affix_right')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_birth')->nullable();
            $table->string('place_birth')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('langugaes')->nullable();
            $table->string('residental_address')->nullable();
            $table->string('international_passport')->nullable();
            $table->string('office_shop')->nullable();

            // $table->integer('martic_number')->nullable();
            $table->string('tertiary_i')->nullable();
            $table->string('tertiary_y')->nullable();
            $table->string('tertiary_yg')->nullable();
            $table->string('secondary')->nullable();
            $table->string('s_year_of_entry')->nullable();
            $table->string('s_year_of_gradution')->nullable();
            $table->string('p_year')->nullable();
            $table->string('p_year_g')->nullable();
            $table->string('primary')->nullable();
            // $table->integer('martic_number')->nullable();
            $table->string('last_place')->nullable();
         
            $table->string('address_employer')->nullable();
            $table->string('Penultimate_Place')->nullable();
            $table->string('address_of_empolyer')->nullable();
            // $table->integer('martic_number')->nullable();
            $table->string('nationality')->nullable();
            
            $table->string('state')->nullable();
            $table->string('ethnic_group')->nullable();
            $table->string('local_govt')->nullable();
            $table->string('town_village')->nullable();
            // $table->integer('martic_number')->nullable();
            $table->longText('relationship')->nullable();
            $table->longText('crime')->nullable();
            $table->longText('penalty')->nullable();
            $table->longText('time_known')->nullable();
            $table->longText('surety_requirement')->nullable();
            $table->longText('prior_case')->nullable();
            $table->longText('prior_surety')->nullable();
            $table->longText('suspect_name')->nullable();
            $table->longText('date_signature')->nullable();
          
            // $table->integer('martic_number')->nullable();
            // $table->foreignId('user_id')->constrained('suspectinfomations');
            $table->string('hereby_name')->nullable();
            $table->string('hereby_signature')->nullable();
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
        Schema::dropIfExists('supect_infos');
    }
}
