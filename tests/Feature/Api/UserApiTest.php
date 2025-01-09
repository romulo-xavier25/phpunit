<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    private string $endpoint = '/api/users';

    /**
     * @dataProvider dataProviderPagination
     */
    public function testGetPaginate(
        int $total, int $totalPage = 15, int $page = 1
    ): void
    {
        User::factory()->count($total)->create();
        $response = $this->getJson($this->endpoint . '?page=' . $page);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount($totalPage, 'data');
        $response->assertJsonStructure([
            'meta' => [
                'total',
                'per_page',
                'current_page',
                'last_page',
            ],
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                ]
            ]
        ]);
        $response->assertJsonFragment([
            'total' => $total,
            'current_page' => $page,
        ]);
    }

    public static function dataProviderPagination() : array
    {
        return [
            'test total paginate empty' => ['total' => 0, 'totalPage' => 0, 'page' => 1],
            'test total 40 users page 1' => ['total' => 40, 'totalPage' => 15, 'page' => 1],
            'test total 20 users page 2' => ['total' => 20, 'totalPage' => 5, 'page' => 2],
        ];
    }

    /**
     * @dataProvider dataProviderCreateUser
     */
    public function testCreate(
        array $payload,
        int $statusCode,
        array $structureResponse,
    )
    {
        $response = $this->postJson($this->endpoint, $payload);

        $response->assertStatus($statusCode);
        $response->assertJsonStructure($structureResponse);
    }

    public static function dataProviderCreateUser(): array
    {

        return [
            'test created' => [
                'payload' => [
                    'name' => 'Romulo',
                    'email' => 'romulo@gmail.com',
                    'password' => '12345678',
                ],
                'statusCode' => Response::HTTP_CREATED,
                'structureResponse' => [
                    'data' => [
                        'id',
                        'name',
                        'email',
                    ]
                ]
            ],
            'test validation' => [
                'payload' => [],
                'statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'structureResponse' => []
            ],
        ];
    }

    public function testFind()
    {
        $user = User::factory()->create();
        $response = $this->getJson($this->endpoint . '/' . $user->email);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
            ]
        ]);
    }

    public function testFindNotFound()
    {
        $response = $this->getJson($this->endpoint . '/fake_email');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
