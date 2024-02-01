<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRolesTimestampsDatatype extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->timestamp('created_at')->default(now())->nullable()->change();
            $table->timestamp('updated_at')->default(now())->nullable()->change();
        });
    }

    public function down()
    {
        // If needed, you can define the rollback logic here
        // Note: Changing the datatype back might lead to data loss
    }
}
