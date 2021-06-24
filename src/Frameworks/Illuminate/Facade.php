<?php

namespace Artadmin\Frameworks\Illuminate;


use Illuminate\Support\Facades\Facade as IlluminateFacade;


/**
 * Class Facade
 * @package PrizyvaNet\Vault\Frameworks\Illuminate
 *
 * @method static mixed get(string $key, mixed $default = null)
 */
class Facade extends IlluminateFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return true;
    }
}

