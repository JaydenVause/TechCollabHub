<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Topic;


class TopicTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $topic = Topic::factory()->create();

        $response = $this->get('/topics/' . $topic->name);

        $response->assertSee($topic->name);
    }
}
