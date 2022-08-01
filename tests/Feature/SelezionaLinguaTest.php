<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\SelezionaLinguaTest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SelezionaLinguaTest extends TestCase
{
    use RefreshDatabase;
    public function test_seleziona_lingua()
    {
        $locale = 'it';
        $response = $this->post(route('locale' , $locale));
        $response->assertStatus(302);   
    }
}
