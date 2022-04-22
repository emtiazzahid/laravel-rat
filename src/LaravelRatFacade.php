<?php

namespace Emtiazzahid\LaravelRat;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Emtiazzahid\LaravelRat\Skeleton\SkeletonClass
 */
class LaravelRatFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-rat';
    }
}
