<?php namespace Albrightlabs\Contact\Models;

use Model;

/**
 * Message Model
 */
class Message extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'albrightlabs_contact_messages';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];
}
