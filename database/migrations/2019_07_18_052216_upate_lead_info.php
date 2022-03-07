<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpateLeadInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rep_user_listings', function (Blueprint $table) {
            $table->string('badge_id')->nullable();
            $table->string('lead_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            
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
