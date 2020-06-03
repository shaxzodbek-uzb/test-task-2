<?php
namespace Console\App\Notifiers;

use Console\App\Contracts\NotifierContract;

class FirebaseNotifier implements NotifierContract
{
    private $receiver_key;
    private $subject;
    private $message;

    // setup parameters for notification
    public function setup($user, $order)
    {
        //setup firebase
    }

    // send notification
    public function notify()
    {
        return true;
    } 
}
