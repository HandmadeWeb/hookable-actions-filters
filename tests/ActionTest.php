<?php

namespace Michaelr0\ActionsAndFilters\Tests;

use Orchestra\Testbench\TestCase;
use Michaelr0\HookableActionsAndFilters\Action;
use Michaelr0\HookableActionsAndFilters\Providers\HookableActionsAndFiltersServiceProvider;

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
