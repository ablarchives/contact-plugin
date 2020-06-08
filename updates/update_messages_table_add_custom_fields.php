<?php namespace Albrightlabs\Contact\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateMessagesTableAddCustomfields extends Migration
{
    public function up()
    {
        Schema::table('albrightlabs_contact_messages', function($table) {
            $table->timestamp('custom_fields')->nullable();
        });
    }

    public function down()
    {
        Schema::table('albrightlabs_contact_messages', function($table) {
            $table->dropColumn('custom_fields');
        });
    }
}
