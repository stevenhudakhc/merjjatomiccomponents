<?php

namespace Stevenhudakhc\Merjjatomiccomponents\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Stevenhudakhc\Merjjatomiccomponents\Merjjatomiccomponents
 */
class Merjjatomiccomponents extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Stevenhudakhc\Merjjatomiccomponents\Merjjatomiccomponents::class;
    }
}
