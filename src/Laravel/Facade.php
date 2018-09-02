<?php

namespace Scuttlebyte\ContextManager\Laravel;

use Illuminate\Support\Facades\Facade as LaravelFacade;
use Scuttlebyte\ContextManager\ContextManager;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return ContextManager::class;
    }
}
