<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0'); // to avoid error during migration
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address');
            $table->string('phonenumber');
            $table->string('student_id')->unique();
            $table->integer('type'); // if 3 => admin, 2 => staff, 1 => student, 0 => blocked
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('specialization_id')->unsigned();
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade')->onUpdate('cascade');
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string('bio')->nullable();
            $table->string('staff_image')->nullable();
            $table->string('adminrequest')->default(0);
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
        Schema::drop('users');
    }
}
