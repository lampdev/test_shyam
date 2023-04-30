<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTenantsTableWithUuid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tenant_user', function (Blueprint $table) {
            $table->dropForeign('tenant_user_tenant_id_foreign');
        });

        Schema::table('tenant_user', function (Blueprint $table) {
            $table->uuid('tenant_id')->change();
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->uuid('tenant_id')->change();
        });

        Schema::table('tenants', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->uuid('id')->change()->primary();
        });

        Schema::table('tenant_user', function (Blueprint  $table) {
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants');
        });

        Schema::table('settings', function (Blueprint $table) {
           $table->foreign('tenant_id')
               ->references('id')
               ->on('tenants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenant_user', function (Blueprint $table) {
            $table->dropForeign('tenant_user_tenant_id_foreign');
        });

        Schema::table('tenant_user', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->change();
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropForeign('settings_tenant_id_foreign');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->change();
        });

        Schema::table('tenants', function (Blueprint $table) {
            $table->dropPrimary('id');
            $table->unsignedBigInteger('id')->change()->primary();
        });

        Schema::table('tenant_user', function (Blueprint  $table) {
            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants');
        });
    }
}
