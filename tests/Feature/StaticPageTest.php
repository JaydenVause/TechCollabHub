<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StaticPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_about_page(){
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function test_services_page(){
        $response = $this->get('/services');

        $response->assertStatus(200);
    }

    public function test_contact_us_page(){
        $response  = $this->get('/contact');

        $response->assertStatus(200);
    }
}
