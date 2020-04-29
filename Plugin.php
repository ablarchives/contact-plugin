<?php namespace Albrightlabs\Contact;

use Backend;
use System\Classes\PluginBase;

/**
 * Contact Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Contact',
            'description' => 'A simple contact plugin.',
            'author'      => 'Albright Labs',
            'icon'        => 'icon-envelope'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Albrightlabs\Contact\Components\Contact' => 'contact',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'albrightlabs.contact.manage_messages' => [
                'tab'   => 'Contact',
                'label' => 'View and manage messages from contact page',
                'order' => 100,
                'roles' => ['developer', 'publisher']
            ],
            'albrightlabs.contact.manage_settings' => [
                'tab'   => 'Contact',
                'label' => 'View and manage contact settings',
                'order' => 200,
                'roles' => ['developer', 'publisher']
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'messages' => [
                'label'       => 'Contact',
                'url'         => Backend::url('albrightlabs/contact/messages'),
                'icon'        => 'icon-envelope',
                'iconSvg'     => 'plugins/albrightlabs/contact/assets/img/icons/plugin-icon.svg',
                'permissions' => ['albrightlabs.contact.manage_messages'],
                'order'       => 600,
                'counter'     => ['\AlbrightLabs\Contact\Controllers\Messages', 'getUnreadMessages'],
                'counterLabel'=> 'Unread messages',
            ],
        ];
    }

    /**
     * Registers back-end settings items for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Contact settings',
                'description' => 'Manage contact page settings.',
                'category'    => 'Contact',
                'icon'        => 'icon-envelope',
                'class'       => 'Albrightlabs\Contact\Models\Settings',
                'order'       => 600,
                'keywords'    => 'contact form',
                'permissions' => ['albrightlabs.contact.manage_settings']
            ]
        ];
    }
}
