<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('body')->nullable();
            $table->string('image')->nullable();
            $table->string('revealed_title')->nullable();
            $table->string('revealed_body')->nullable();
            $table->string('revealed_image')->nullable();
            $table->json('features')->nullable();
            $table->string('link_to_site')->nullable();
            $table->string('link_to_source')->nullable();
            $table->string('link_to_blog')->nullable();
            
            $table->softDeletes();
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
        Schema::dropIfExists('portfolios');
    }
}
