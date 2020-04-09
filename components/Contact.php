<?php namespace Albrightlabs\Contact\Components;

use Mail;
use Flash;
use Config;
use Request;
use Redirect;
use Exception;
use Validator;
use ValidationException;
use Backend\Models\User;
use Albrightlabs\Contact\Models\Message;
use Albrightlabs\Contact\Models\Settings;
use Cms\Classes\ComponentBase;

class Contact extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Contact Form',
            'description' => 'Adds a basic contact form to a page.',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->addCss('/plugins/albrightlabs/contact/assets/css/styles.css');
        $this->addJs('/plugins/albrightlabs/contact/assets/js/scripts.js');
    }

    /**
     *  Return contact email address
     */
    public function email()
    {
        return Settings::get('email');
    }

    /**
     *  Return contact phone number
     */
    public function phone()
    {
        return Settings::get('phone');
    }

    /**
     *  Return contact address
     */
    public function address()
    {
        return Settings::get('address');
    }

    /**
     *  Return contact company name
     */
    public function company()
    {
        return Settings::get('company');
    }

    /**
     *  Return contact success message
     */
    public function successMessage()
    {
        return Settings::get('success');
    }

    /**
     * Sends contact form message
     */
    public function onSendContactForm()
    {
        try {
            // retireve data
            $data = post();

            // validate users
            $rules = [
                'name'    => 'required|between:2,255',
                'email'   => 'required|email|between:6,255',
                'phone'   => 'digits:10',
                'message' => 'required|between:2,65535'
            ];
            $validation = Validator::make($data, $rules);
            if ($validation->fails()) {
                throw new ValidationException($validation);
            }

            // create message
            $message = new Message;
            $message->name    = $data['name'];
            $message->email   = $data['email'];
            $message->phone   = $data['phone'];
            $message->message = $data['message'];
            $message->save();

            // retrieve contact settings
            $settings = Settings::instance();

            // retrieve the notify admin
            $admin = User::find($settings->user_id);

            // notify user of new message
            $vars = [
                'name' => $admin->first_name.' '.$admin->last_name,
                'link' => 'backend/albrightlabs/contact/messages/preview/'.$message->id,
            ];
            Mail::send('albrightlabs.contact::mail.notification', $vars, function($message) use ($admin) {
                $message->to($admin->email, $admin->first_name.' '.$admin->last_name);
            });
        }
        catch (Exception $ex) {
            if (Request::ajax()) throw $ex;
            else Flash::error($ex->getMessage());
        }

    }
}
