<?php

use Illuminate\Support\Facades\Facade;

class SubUser extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'subUser';
    }
}