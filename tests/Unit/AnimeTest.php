<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Anime;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnimeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_anime()
    {
        $anime = Anime::create([
            'title' => 'My Hero Academia',
            'genre' => 'Action',
            'season' => 5,
            'episode' => 25,
        ]);

        $this->assertDatabaseHas('animes', [
            'title' => 'My Hero Academia',
            'genre' => 'Action',
            'season' => 5,
            'episode' => 25,
        ]);
    }
}
