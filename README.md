# Contact Plugin for OctoberCMS

**Background**  
A plugin provides a simple contact form, inbox, and new message notifications. A contact form component will be available to display the form. This component returns an HTML block that can be modified as needed. Successful form submission will display a banner which can be managed in the administration area settings.  

**Features**  
- Contact form component
- Submission inbox
- Message notifications
- Supports custom field storage

**Install**  
There are two options:
- `git clone https://github.com/albrightlabs/contact-plugin.git plugins/albrightlabs/contact` and run `php artisan october:up` or
- `git submodule add -b master https://github.com/albrightlabs/contact-plugin.git plugins/albrightlabs/contact` and run `php artisan october:up`

**Update**  
- `git pull origin master` or
- `git pull --recursive-submodules`

**Usage**  
1. Add the contact component to the page you wish to display the form
2. Override/modify the HTML and CSS as needed
3. Override `onSendContactForm()` function if/as needed
4. Go to settings, contact and configure as needed (set the notification recipient, company contact information and location, and form submission success message)
5. When a message comes in, open link in notification or go to messages in administration area to view message  
*Note: unopened messages are marked as new.*  

Display other contact information on the site using the following Twig variables:
* `{{ contact.email }}` will display email from Contact settings
* `{{ contact.phone }}` will display phone from Contact settings
* `{{ contact.address }}` will display address from Contact settings

**Contribute**  
Feel free to fork and contribute to this plugin! Please email support@albrightlabs.com with any and all questions.
