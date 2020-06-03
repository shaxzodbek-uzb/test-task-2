<?php
namespace Console\App\Exceptions;

class ModelNotFoundException extends \Exception
{
    public function __construct($model_name)
    {
        parent::__construct("Model of {$model_name} not found with a given params", '2001');
    }
}
