<?php

namespace Sven\LaravelCollectionTestingHelpers\Tests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\TestCase;
use Sven\LaravelCollectionTestingHelpers\Helpers;

class CollectionTest extends TestCase
{
    protected function setUp(): void
    {
        Helpers::enable();

        parent::setUp();
    }

    /** @test */
    public function it_contains_the_item(): void
    {
        $collection = collect(['apple', 'pear', 'banana']);

        $collection->assertContains('apple');
        $collection->assertNotContains('orange');
    }

    /** @test */
    public function it_fails_when_the_item_is_not_in_the_collection(): void
    {
        $this->expectException(AssertionFailedError::class);

        collect(['apple'])->assertContains('pear');
    }

    /** @test */
    public function it_fails_when_the_expected_missing_item_exists(): void
    {
        $this->expectException(AssertionFailedError::class);

        collect(['apple'])->assertNotContains('apple');
    }

    /** @test */
    public function it_contains_the_item_with_callable(): void
    {
        $collection = collect(['apple', 'pear', 'banana']);

        $collection->assertContains(fn ($value) => $value === 'pear');
        $collection->assertNotContains(fn ($value) => $value === 'orange');
    }

    /** @test */
    public function it_fails_when_the_item_is_not_in_the_collection_with_callable(): void
    {
        $this->expectException(AssertionFailedError::class);

        collect(['apple'])->assertContains(fn ($value) => $value === 'pear');
    }

    /** @test */
    public function it_fails_when_the_expected_missing_item_exists_with_callable(): void
    {
        $this->expectException(AssertionFailedError::class);

        collect(['apple'])->assertNotContains(fn ($value) => $value === 'apple');
    }

    /** @test */
    public function it_contains_the_item_with_key_value_pair(): void
    {
        $collection = collect([['name' => 'apple'], ['name' => 'pear'], ['name' => 'banana']]);

        $collection->assertContains('name', 'banana');
        $collection->assertNotContains('name', 'orange');
    }

    /** @test */
    public function it_fails_when_the_item_is_not_in_the_collection_with_key_value_pair(): void
    {
        $this->expectException(AssertionFailedError::class);

        collect([['name' => 'apple']])->assertContains('name', 'pear');
    }

    /** @test */
    public function it_fails_when_the_expected_missing_item_exists_with_key_value_pair(): void
    {
        $this->expectException(AssertionFailedError::class);

        collect([['name' => 'apple']])->assertNotContains('name', 'apple');
    }

    /** @test */
    public function it_can_chain_collection_calls(): void
    {
        collect(['apple', 'pear', 'banana'])
            ->assertContains('apple')
            ->assertNotContains('orange')
            ->assertContains(fn ($value) => $value === 'pear')
            ->assertNotContains(fn ($value) => $value === 'kiwi');

        collect([['name' => 'apple'], ['name' => 'pear'], ['name' => 'banana']])
            ->assertContains('name', 'apple')
            ->assertNotContains('name', 'grape');
    }
}
