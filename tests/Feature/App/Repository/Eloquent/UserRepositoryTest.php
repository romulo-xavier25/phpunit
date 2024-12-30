<?php

namespace Tests\Feature\App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Contracts\UserRepositoryInterface;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    protected $userRepository;
    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(new User());
        parent::setUp();
    }

    public function testImplementsInterface()
    {
        $this->assertInstanceOf(
            UserRepositoryInterface::class,
            $this->userRepository
        );
    }

    /**
     * A basic feature test example.
     */
    public function testFindAll(): void
    {
        $response = $this->userRepository->findAll();

        $this->assertIsArray($response);
    }

    public function testFindAllEmpty(): void
    {
        User::factory()->count(10)->create();

        $response = $this->userRepository->findAll();

        $this->assertCount(10, $response);
    }
}
