<?php namespace Albrightlabs\Contact\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'albrightlabs_contact_settings';

    public $settingsFields = 'fields.yaml';

    public $belongsTo = [
    	'user' => '\Backend\Models\User',
    ];
}
