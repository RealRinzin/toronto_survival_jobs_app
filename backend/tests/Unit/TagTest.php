<?php

namespace Tests\Unit;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_tag_can_be_saved(): void
    {
        Tag::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
            'description' => 'PHP framework',
            'tagline' => 'Build fast',
        ]);

        $this->assertDatabaseHas('tags', ['name' => 'Laravel']);
    }

    public function test_two_tags_cannot_have_the_same_name(): void
    {
        Tag::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
            'description' => 'PHP framework',
            'tagline' => 'Build fast',
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        Tag::create([
            'name' => 'Laravel',
            'slug' => 'laravel-2',
            'description' => 'Another one',
            'tagline' => 'Duplicate',
        ]);
    }

    public function test_tags_endpoint_returns_tags(): void
    {
        Tag::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
            'description' => 'PHP framework',
            'tagline' => 'Build fast',
        ]);

        $response = $this->getJson('/api/v1/public/tags'); // use your real path

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Laravel']);
    }
}