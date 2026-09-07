<?php

use Illuminate\Support\Facades\Http;
use JeffersonGoncalves\G2\Tests\TestCase;

uses(TestCase::class)
    ->beforeEach(fn () => Http::preventStrayRequests())
    ->in('Feature');
