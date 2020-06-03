<?php
namespace Console\App\Contracts;

interface NotifierContract{

    // setup parameters for notification
    public function setup($user, $order);
    
    // send notification
    public function notify();

}