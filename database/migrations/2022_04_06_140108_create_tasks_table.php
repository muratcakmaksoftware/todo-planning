<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true); //BIGINT 0 - 18446744073709551615
            $table->string('name', 255); //varchar(255)
            $table->unsignedTinyInteger('level'); //TINYINT 0-255
            $table->unsignedTinyInteger('estimated_duration'); //TINYINT 0-255
            $table->timestamps(); // created_at - updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
