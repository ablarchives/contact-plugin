<?php namespace Albrightlabs\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use AlbrightLabs\Contact\Models\Message;

/**
 * Messages Back-end Controller
 */
class Messages extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Albrightlabs.Contact', 'messages');
    }

    /**
     * Provide the navigation with unread messages
     */
    static function getUnreadMessages()
    {
      return Message::whereNull('read_at')->count();
    }

    /**
     * Extend preview action to mark message as read
     */
    public function preview($context = null) {
        $message = Message::find($this->params[0]);
        $message->read_at = date('Y-m-d H:i:s', strtotime('now'));
        $message->save();

        return $this->asExtension('FormController')->preview($context);
    }
}
