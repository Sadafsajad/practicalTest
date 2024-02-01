<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        // Rename 'name' to 'firstname'
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'firstname');
        });

        // Add new columns
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->after('firstname')->nullable();
            $table->string('phoneNumber')->after('lastname')->nullable();
            $table->string('postcode')->after('phoneNumber')->nullable();
            $table->string('state')->after('postcode')->nullable();
            $table->string('city')->after('state')->nullable();
            $table->text('hobbies')->after('city')->nullable();
            $table->string('gender')->after('hobbies')->nullable();
            $table->text('images')->after('gender')->nullable();
        });
    }

    public function down()
    {
        // Reverse the changes if needed
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('firstname', 'name');
            $table->dropColumn(['lastname', 'phoneNumber', 'postcode', 'state', 'city', 'hobbies', 'gender', 'images']);
        });
    }
}
