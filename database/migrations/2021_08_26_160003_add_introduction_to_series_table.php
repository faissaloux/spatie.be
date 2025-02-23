<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIntroductionToSeriesTable extends Migration
{
    public function up()
    {
        Schema::table('series', function (Blueprint $table) {
            $table->longText('introduction')->nullable();
        });
    }
}
