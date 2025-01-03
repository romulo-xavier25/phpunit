<?php

namespace Tests\Feature\Api;

use Illuminate\Http\Response;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    private string $endpoint = '/api/users';

    public function test_example(): void
    {
        $response = $this->getJson($this->endpoint . '/');

        $response->assertStatus(Response::HTTP_OK);
    }
}
