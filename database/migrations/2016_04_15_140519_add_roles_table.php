<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        try {
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();
            });

            Schema::create('users_roles', function (Blueprint $table) {
                $table->integer('role_id');
                $table->integer('user_id');

                $table->primary(['user_id', 'role_id']);
            });
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::beginTransaction();

        try {
            Schema::drop('roles');

            Schema::drop('users_roles');
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }

        DB::commit();
    }
}
