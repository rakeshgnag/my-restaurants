<?php

namespace App\Constants;

use Illuminate\Support\Facades\Facade;

class ErrorType  extends Facade {

    /**
     * Constant representing an validation failed.
     *
     * @var string
     */
    const NO_PERMISSION = 'no_permission';
    
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ErrorType';
    }
}