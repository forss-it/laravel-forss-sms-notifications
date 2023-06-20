#Laravel Forss SMS Notifications

### Setting up the forss API service

Extend `config/services.php` to read your Forss SMS API credentials from your `.env`:

```php
return [
    ...

    'forss_sms' => [
        'username' => env('FORSS_SMS_USERNAME'),
        'password' => env('FORSS_SMS_PASSWORD'),
        'sender' => env('FORSS_SMS_SENDER'),
    ]
];
```

Add your Forss SMS API credentials to your `.env`:
```bash
FORSS_SMS_USERNAME=username
FORSS_SMS_PASSWORD=password
FORSS_SMS_SENDER=sender
```

# Usage

### Create a Notification

When your credentials are configured, you can use the `sipgate` channel in your notifications.

```php
class ExampleNotification extends Notification
{
    public function via($notifiable)
    {
        return [];
    }

    public function toSipgate($notifiable)
    {
        return SipgateMessage::create('Your message goes here…');
    }
}
```

### Add a recipient

Add a `toForssSms` method to your Notification class:

```php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Forss\Laravel\Notifications\ForssSms\ForssSmsMessage;
use Forss\Laravel\Notifications\ForssSms\ForssSmsChannel;
class TestSms extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [ForssSmsChannel::class];
    }

 

    public function toForssSms() {
        return ForssSmsMessage::create('Hello World');
    }

}

```

Add a `routeNotificationForForssSms` method to your Notifiable class:

```php
class User extends Authenticatable
{
    use Notifiable;

    public function routeNotificationForForssSms()
    {
        //Return whatever phone number to use for the SMS
        return $this->phone;
    }
}
```