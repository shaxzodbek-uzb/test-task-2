<?php
namespace Console\App\Factories;

use Console\App\Notifiers\PusherNotifier;
use Console\App\Notifiers\SmsNotifier;
use Console\App\Notifiers\EmailNotifier;
use Console\App\Notifiers\FirebaseNotifier;
use Console\App\Notifiers\TelegramNotifier;

class NotifierFactory
{
    public function getNotifier($notifier)
    {
        // find notifier with slug name
        switch ($notifier) {
            case 'pusher':
                return new PusherNotifier;
                break;
            case 'sms':
                return new SmsNotifier;
                break;
            case 'email':
                return new EmailNotifier;
                break;
            case 'firebase':
                return new FirebaseNotifier;
                break;
            case 'telegram':
                return new TelegramNotifier;
                break;
            default: throw new NotifierNotFoundException($notifier);
        }
    }
}
