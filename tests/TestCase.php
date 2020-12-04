<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;
    use ReflectionTrait;

    protected function setUp(): void
    {
        parent::setUp();

        //no need to do migrate because RefreshDatabase Trait will help on this
        //$this->artisan('migrate');
        //$this->artisan('db:seed');

        $this->withoutExceptionHandling(); //To get the actual Exception whenever it occurs instead of Laravel handing the exception.
    }
}
