<?php namespace Mews\Thumb\Facades;

use Illuminate\Support\Facades\Facade;

class Thumb extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'thumb'; }

}