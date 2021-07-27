<?php

namespace HandmadeWeb\HookableActionsAndFilters\Tests;

use HandmadeWeb\HookableActionsAndFilters\Filter;
use HandmadeWeb\HookableActionsAndFilters\Providers\HookableActionsAndFiltersServiceProvider;
use Orchestra\Testbench\TestCase;

class FilterTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [HookableActionsAndFiltersServiceProvider::class];
    }

    /** @test */
    public function filtersWork()
    {
        Filter::add('test', function () {
            return 'foobar';
        }, 10, 0);
        Filter::add('test', 'strtoupper', 10, 1);
        Filter::add('test', function (...$args) {
            return "{$args[0]} {$args[0]}";
        }, 10, 3);

        $this->assertTrue(Filter::run('test', null, null, null) === 'FOOBAR FOOBAR');
    }
}
