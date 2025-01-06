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
        $response->assertJsonFragment([
            'total' => 0,
        ]);
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
        $response->assertJsonFragment([
            'total' => 40,
        ]);
    }

    public function testPageTwo(): void
    {
        User::factory()->count(20)->create();
        $response = $this->getJson($this->endpoint . '?page=2');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(5, 'data');
        $response->assertJsonFragment([
            'total' => 20,
            'per_page' => 15,
        ]);
    }
}
