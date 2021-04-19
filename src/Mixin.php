<?php

namespace Sven\LaravelCollectionTestingHelpers;

use PHPUnit\Framework\Assert as PHPUnit;

class Mixin
{
    public function assertContains(): callable
    {
        return function ($key, $operator = null, $value = null) {
            /* @var \Illuminate\Support\Collection $this */
            PHPUnit::assertTrue(
                $this->contains(...func_get_args()),
                'Failed asserting that the collection contains the specified value.'
            );

            return $this;
        };
    }

    public function assertNotContains(): callable
    {
        return function ($key, $operator = null, $value = null) {
            /* @var \Illuminate\Support\Collection $this */
            PHPUnit::assertFalse(
                $this->contains(...func_get_args()),
                'Failed asserting that the collection does not contain the specified value.'
            );

            return $this;
        };
    }
}
