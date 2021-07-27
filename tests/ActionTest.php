<?php

namespace HandmadeWeb\ActionsAndFilters\Tests;

use HandmadeWeb\HookableActionsAndFilters\Action;
use HandmadeWeb\HookableActionsAndFilters\Providers\HookableActionsAndFiltersServiceProvider;
use Orchestra\Testbench\TestCase;

class ActionTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [HookableActionsAndFiltersServiceProvider::class];
    }

    /** @test */
    public function actionsWork()
    {
        $actionsWork = false;
        Action::add('test', function () use (&$actionsWork) {
            $actionsWork = true;
        });
        Action::run('test');
        $this->assertTrue($actionsWork);
        Action::add('test', function () use (&$actionsWork) {
            $actionsWork = false;
        });
        Action::run('test');
        $this->assertFalse($actionsWork);
    }
}
