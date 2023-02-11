<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 20)->change();
            $table->string('password', 256)->change();
            $table->string('cep', 8)->after('password');
            $table->string('address', 256)->after('cep');
            $table->string('city', 100)->after('address');
            $table->string('state', 2)->after('city');
            $table->integer('number')->after('state');
            $table->string('complement', 100)->nullable()->after('number');

            $table->dropColumn('email');
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
            $table->string('name')->change();
            $table->dropColumn('cep');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('number');
            $table->dropColumn('complement');
        });
    }
}
