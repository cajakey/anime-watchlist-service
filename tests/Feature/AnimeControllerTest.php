<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Anime;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnimeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_fetches_anime_list()
    {
        Anime::factory()->create([
            'title' => 'My Hero Academia',
        ]);

        $response = $this->getJson('/api/animes');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'My Hero Academia']);
    }

    /** @test */
    public function it_filters_anime_by_title()
    {
        Anime::factory()->create([
            'title' => 'My Hero Academia',
        ]);

        Anime::factory()->create([
            'title' => 'Attack on Titan',
        ]);

        $response = $this->getJson('/api/animes?title=Hero');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'My Hero Academia'])
                 ->assertJsonMissing(['title' => 'Attack on Titan']);
    }

    /** @test */
    public function it_creates_an_anime()
    {
        $animeData = [
            'title' => 'My Hero Academia',
            'genre' => 'Action',
            'season' => 5,
            'episode' => 25,
        ];

        $response = $this->postJson('/api/animes', $animeData);

        $response->assertStatus(201)
                 ->assertJsonFragment($animeData);

        $this->assertDatabaseHas('animes', $animeData);
    }

    /** @test */
    public function it_updates_an_anime()
    {
        $anime = Anime::factory()->create();

        $updatedData = [
            'title' => 'My Hero Academia',
            'genre' => 'Action',
            'season' => 5,
            'episode' => 25,
        ];

        $response = $this->putJson("/api/animes/{$anime->id}", $updatedData);

        $response->assertStatus(200)
                 ->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('animes', $updatedData);
    }

    /** @test */
    public function it_deletes_an_anime()
    {
        $anime = Anime::factory()->create();

        $response = $this->deleteJson("/api/animes/{$anime->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('animes', ['id' => $anime->id]);
    }
}