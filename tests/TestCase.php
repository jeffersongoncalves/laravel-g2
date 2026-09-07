<?php

namespace JeffersonGoncalves\G2\Tests;

use JeffersonGoncalves\G2\G2ServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            G2ServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('g2.token', 'fake-token');
        $app['config']->set('g2.base_url', 'https://data.g2.com/api/v1');
    }
}
