<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class clientTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/client/edit/5');
        $response->assertStatus(200);
        $response->assertSee("Editado Cliente: 5");
    }

    public function test_new(): void
    {
        $response = $this->get('/client/new');
        $response->assertStatus(200);
        $response->assertSee("Vista Nuevo Cliente");
    }

    public function test_delete(): void
    {
        $response = $this->get('/client/delete/5');
        $response->assertStatus(200);
        $response->assertSee("Eliminando Cliente: 5");
    }

    public function test_delete2(): void
    {
        $response = $this->get('/client/delete/5/10');
        $response->assertStatus(200);
        $response->assertSee("Eliminando Cliente: 5 y 10");
    }

    public function test_show(): void
    {
        $response = $this->get('/client/show/5');
        $response->assertStatus(200);
        $response->assertSee("Muestra Cliente: 5");
    }

    
}
