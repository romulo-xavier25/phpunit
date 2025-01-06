<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    private string $endpoint = '/api/users';

    public function testGetPaginateEmpty(): void
    {
        $response = $this->getJson($this->endpoint);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'meta' => [
                'total',
                'per_page',
                'current_page',
                'last_page',
            ]
        ]);
        $this->assertEquals(0, $response->json('meta.total'));
    }

    public function testGetPaginate(): void
    {
        User::factory()->count(40)->create();
        $response = $this->getJson($this->endpoint);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(15, 'data');
        $response->assertJsonStructure([
            'meta' => [
                'total',
                'per_page',
                'current_page',
                'last_page',
            ]
        ]);
        $this->assertEquals(40, $response->json('meta.total'));
    }

    public function testPageTwo(): void
    {
        User::factory()->count(20)->create();
        $response = $this->getJson($this->endpoint . '?page=2');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(5, 'data');
        $this->assertEquals(20, $response->json('meta.total'));
        $this->assertEquals(15, $response->json('meta.per_page'));
    }
}
