<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCusomterBaseColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function(Blueprint $table) {
            $table->string('companyname');
            $table->string('companyphone');
            $table->string('companyemail');
            $table->string('companywebsite');
            $table->string('address');
            $table->integer('number');
            $table->string('numberaddition');
            $table->string('postalcode');
            $table->string('city');
            $table->string('country');
            $table->text('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
