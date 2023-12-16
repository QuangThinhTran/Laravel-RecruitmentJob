<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;
    public function test_example(): void
    {
        $t = true;
        $this->assertTrue($t);
    }
}
