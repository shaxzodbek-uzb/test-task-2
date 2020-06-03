<?php
namespace Console\App\Notifiers;

use Console\App\Contracts\NotifierContract;
use Console\App\Exceptions\NotificationNotSent;

class EmailNotifier implements NotifierContract
{
    private $receiver_key;
    private $subject;
    private $message;
    // setup parameters for notification
    public function setup($user, $order)
    {
        $this->receiver_key = $user['email'];
        $this->subject = "Order #{$order['id']} has been completed!";
        $this->message = "Order #{$order['id']} has been completed by {$user['name']}. Please check informations by clicking this <a href=\"#\">link</a>";
        
        // Always set content-type when sending HTML email
        $this->headers = "MIME-Version: 1.0\r\n";
        $this->headers .= "Content-type:text/html;charset=UTF-8\r\n";

        // More headers
        $this->headers .= "From: <admin@task.uz>\r\n";
        $this->headers .= "Cc: { $this->receiver_key}\r\n";
    }

    // send notification
    public function notify()
    {
        if (mail($this->receiver_key, $this->subject, $this->message, $this->headers)){
            return true;
        }
        else{
            throw new NotificationNotSent($this->receiver_key, $this->subject, $this->message);
        }
        return false;
    } 
}
