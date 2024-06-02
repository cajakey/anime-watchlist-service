<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Anime;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnimeValidationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_required_fields_when_creating_an_anime()
    {
        $response = $this->postJson('/api/animes', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['title', 'genre', 'season', 'episode']);
    }

    /** @test */
    public function it_validates_required_fields_when_updating_an_anime()
    {
        $anime = Anime::factory()->create();

        $response = $this->putJson("/api/animes/{$anime->id}", []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['title', 'genre', 'season', 'episode']);
    }
}