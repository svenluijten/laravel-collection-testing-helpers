<?php

namespace Sven\LaravelCollectionTestingHelpers;

use Illuminate\Support\Collection;

class Macros
{
    public static function enable(): void
    {
        Collection::mixin(new Mixin());
    }
}
