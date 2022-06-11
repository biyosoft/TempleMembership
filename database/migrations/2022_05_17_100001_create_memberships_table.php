<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('gvBrowseCode')->nullable();
            $table->string('gvBrowseCompanyName')->nullable();
            $table->string('gvBrowseAttention')->nullable();
            $table->string('gvBrowseUDF_TEMPATLAHIR');
            $table->string('gvBrowseUDF_ICNO');
            $table->string('gvBrowsePhone1');
            $table->string('gvBrowseAddress1');
            $table->date('gvBrowseUDF_DOB');
            $table->string('gvBrowseUDF_NOAHLISKMC');
            $table->date('gvBrowseUDF_TARIKHMEMOHON');
            $table->string('gvBrowseUDF_PEKERJAAN')->nullable();
            $table->string('gvBrowseUDF_JANTINA')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('memberships');
    }
}
