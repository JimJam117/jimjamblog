<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('site_title')->default("James Sparrow")->nullable();
            $table->string('site_subtitle')->default("Web Developer")->nullable();
            
            $table->string('site_welcome')->default("Welcome")->nullable();

            $table->text('home_body')->default("Home Text area.")->nullable();
            $table->string('home_image')->default("/img/sitepic.png")->nullable();


            $table->boolean("display_site_welcome")->default(false);
            $table->boolean("display_site_subtitle")->default(false);
            $table->boolean("display_home_image")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('site_title');
            $table->dropColumn('site_subtitle');
            
            $table->dropColumn('site_welcome');

            $table->dropColumn('home_body');
            $table->dropColumn('home_image');


            $table->dropColumn("display_site_welcome");
            $table->dropColumn("display_site_subtitle");
            $table->dropColumn("display_home_image");
        });
    }
}
