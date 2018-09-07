<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process', function (Blueprint $table) {
            // columns
            $table->uuid('uuid');
            $table->uuid('process_category_uuid');
            $table->uuid('user_uuid');
            $table->string('bpmn');
            $table->string('name');
            $table->enum('status', ['ACTIVE', 'INACTIVE']);
            $table->timestamps();

            // indexes
            $table->primary('uuid');

            // foreign keys
            $table->foreign('user_uuid')->references('uuid')->on('users')->onDelete('cascade');
            $table->foreign('process_category_uuid')->references('uuid')->on('process_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process');
    }
}