<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArtadminCreateRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config("artadmin.tables.roles"), function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create(config("artadmin.tables.permissions"), function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create(config("artadmin.tables.users_permissions"), function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('user_id')->references('id')->on(config("artadmin.tables.users"))->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on(config("artadmin.tables.permissions"))->onDelete('cascade');
            $table->primary(['user_id','permission_id']);
        });


        Schema::create(config("artadmin.tables.users_roles"), function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->foreign('user_id')->references('id')->on(config("artadmin.tables.users"))->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on(config("artadmin.tables.roles"))->onDelete('cascade');
            $table->primary(['user_id','role_id']);
        });

        Schema::create(config("artadmin.tables.roles_permissions"), function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('role_id')->references('id')->on(config("artadmin.tables.roles"))->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on(config("artadmin.tables.permissions"))->onDelete('cascade');
            $table->primary(['role_id','permission_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config("artadmin.tables.roles"));
        Schema::dropIfExists(config("artadmin.tables.permissions"));
        Schema::dropIfExists(config("artadmin.tables.users_permissions"));
        Schema::dropIfExists(config("artadmin.tables.users_roles"));
        Schema::dropIfExists(config("artadmin.tables.roles_permissions"));



    }
}
