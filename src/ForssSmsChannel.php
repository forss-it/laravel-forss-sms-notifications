<?php
 
namespace Forss\Laravel\Notifications\ForssSms;
 
use Illuminate\Notifications\Notification;
 
class ForssSmsChannel
{

    /** @var ForssSmsApi */
    protected $forssSms;

    public function __construct(ForssSmsApi $forssSms)
    {
        $this->forssSms = $forssSms;
    }

    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        $message = $notification->toForssSms($notifiable);
        $this->addRecipient($message, $notifiable);
        
        $this->forssSms->send($message->to, $message->message);
 
    }

    /**
     * @param  ForssSmsMessage  $message
     * @param $notifiable
     */
    protected function addRecipient(ForssSmsMessage $message, $notifiable)
    {

        if ($message->to) {
            return;
        }

        if ($to = $notifiable->routeNotificationFor('forss-sms', $notifiable)) {
            
            $message->to($to);

            return;
        }
    }


}