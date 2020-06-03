<?php
namespace Console\App\Exceptions;

class NotificationNotSent extends \Exception
{
    public function __construct($key, $subject, $message)
    {
        parent::__construct("Notification with params key: {$key}, subject: {$subject}, message: {$message} could not be sent", '2003');
    }
}
