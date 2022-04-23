<?php

namespace Tests\Feature\welcome;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VisualizarLeilaoNaoLogadoTest extends TestCase
{
    public function test_redenrizar_welcome()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }
}
