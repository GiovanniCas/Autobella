<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

   
}
