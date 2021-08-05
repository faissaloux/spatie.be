<?php

namespace Tests;

use App\Support\Browsershot\Browsershot;
use Illuminate\Foundation\Mix;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->swap(Mix::class, function () {
            return '';
        });

        Browsershot::fake();
    }

    public function getStub(string $nameOfStub): string
    {
        return __DIR__ . "/stubs/{$nameOfStub}";
    }
}
