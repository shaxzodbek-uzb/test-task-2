<?php
class NotifierNotFoundException extends \Exception
{
    public function __construct($notifier)
    {
        
        parent::__construct("Notifier named '{$notifier}' not found with a given params", '2002');
    }
}