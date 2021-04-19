<?php

namespace Sven\LaravelCollectionTestingHelpers;

use Illuminate\Support\Collection;

class Helpers
{
    public static function enable(): void
    {
        Collection::mixin(new Mixin());
    }
}
