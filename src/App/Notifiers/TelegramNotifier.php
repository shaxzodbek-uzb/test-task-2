<?php
namespace Console\App\Notifiers;

use Console\App\Contracts\NotifierContract;
use Console\App\Exceptions\NotificationNotSent;


class TelegramNotifier implements NotifierContract
{
    private $token;
    private $data;

    // setup parameters for notification
    public function setup($user, $order)
    {
        $this->token = "YOUR_BOT's_TOKEN";

        $this->data = [
            'text' => "Order #{$order['id']} has been completed by {$user['name']}. Please check informations by clicking this <a href=\"#\">link</a>",
            'chat_id' => $user['telegram_chat_id']
        ];
    }

    // send notification
    public function notify()
    {
        $content = '';
        set_error_handler(function ($severity, $message, $file, $line) {
            throw new NotificationNotSent($message, $severity, $severity, $file, $line);
        });
        $content = file_get_contents("https://api.telegram.org/bot$this->token/sendMessage?" . http_build_query($this->data));
            
        restore_error_handler();

        $content = json_decode($content, true);
        return true;
    } 
}
