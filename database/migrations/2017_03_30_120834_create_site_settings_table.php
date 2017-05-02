<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('site_settings', function (Blueprint $table) {
         DB::statement('SET FOREIGN_KEY_CHECKS=0'); // to avoid error during migration
         $table->increments('id');
         $table->string('slug', 50);
         $table->string('nameSetting', 50);
         $table->text('value');
         $table->boolean('type')->default(0); // 0 => input, 1 => textarea
         $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
         $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      DB::statement('SET FOREIGN_KEY_CHECKS=0'); // to avoid error during migration
      Schema::drop('site_settings');
   }
}
