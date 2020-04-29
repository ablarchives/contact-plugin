<?php namespace Albrightlabs\Contact\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateMessagesTableAddReadAt extends Migration
{
    public function up()
    {
        Schema::table('albrightlabs_contact_messages', function($table) {
            $table->timestamp('read_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('albrightlabs_contact_messages', function($table) {
            $table->dropColumn('read_at');
        });
    }
}
