<?php
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUser extends Migration
{
  
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('ministry_id')->nullable()->after('email');
            $table->integer('agency_id')->nullable()->after('ministry_id');
            $table->integer('department_id')->nullable()->after('agency_id');
            $table->string('phone_number', 16)->nullable()->after('department_id');
            $table->string('status', 16)->after('phone_number')->default(1);
            $table->softDeletes();
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
            $table->dropColumn('ministry_id');
            $table->dropColumn('agency_id');
            $table->dropColumn('department_id');
            $table->dropColumn('phone_number');
            $table->dropColumn('status');
        });
    }
}
