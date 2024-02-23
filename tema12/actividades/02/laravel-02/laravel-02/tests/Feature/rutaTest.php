<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class rutaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_test(): void
    {
        $response = $this->get('/test');
        $response->assertStatus(200);
        $response->assertSee("Ana, DWEservidor, 2ºDAW, Prueba");
    }

    public function test_apiUser(): void
    {
        $response = $this->get('/api/user');
        $response->assertStatus(200);
        $response->assertSee("La informática es una disciplina que promueve la creatividad y la resolución de problemas, donde los límites son solo nuestra imaginación y nuestra capacidad para innovar.");
    }

    public function test_nombreApellidos(): void
    {
        $response = $this->get('/user/Ana/Lopez');
        $response->assertStatus(200);
        $response->assertSee("Ana Lopez");
    }

    public function test_id(): void
    {
        $response = $this->get('/user/view/8');
        $response->assertStatus(200);
        $response->assertSee("view 8");
    }

    public function test_edad(): void
    {
        $response = $this->get('/user/edad/Ana/25');
        $response->assertStatus(200);
        $response->assertSee("Ana tiene 25 años");
    }
}
