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
    }

    public function testGetPaginate(): void
    {
        User::factory()->count(40)->create();
        $response = $this->getJson($this->endpoint);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(15, 'data');
    }

    public function testPageTwo(): void
    {
        User::factory()->count(20)->create();
        $response = $this->getJson($this->endpoint . '?page=2');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(5, 'data');
    }
}
