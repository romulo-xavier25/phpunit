<?php

namespace Tests\Feature\App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Exceptions\NotFoundException;
use Illuminate\Database\QueryException;
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

    public function testCreate()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => bcrypt('123456789'),
        ];
        $response = $this->userRepository->create($data);

        $this->assertNotNull($response);
        $this->assertIsObject($response);
        $this->assertDatabaseHas('users', [
            'email' => 'john@doe.com',
        ]);
    }

    public function testCreateException()
    {
        $this->expectException(QueryException::class);

        $data = [
            'name' => 'John Doe',
            'password' => bcrypt('123456789'),
        ];

        $this->userRepository->create($data);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'John Doe Update',
        ];

        $response = $this->userRepository->update($user->email, $data);

        $this->assertNotNull($response);
        $this->assertIsObject($response);
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe Update',
        ]);
    }

    public function testDelete()
    {
        $user = User::factory()->create();

        $response = $this->userRepository->delete($user->email);

        $this->assertTrue($response);
        $this->assertDatabaseMissing('users', [
            'email' => $user->email,
        ]);
    }

    public function testDeleteNotFound()
    {
        try {
            $this->userRepository->delete("fake_email@gmail.com");

            $this->assertTrue(false);
        } catch (\Exception $exception) {
            $this->assertInstanceOf(NotFoundException::class, $exception);
        }
    }

    public function testFindByEmail()
    {
        $user = User::factory()->create();

        $response = $this->userRepository->findByEmail($user->email);

        $this->assertIsObject($response);
    }

    public function testFindByEmailNotFound()
    {
        $this->expectException(NotFoundException::class);
        $this->userRepository->findByEmail("fake_email@gmail.com");
    }
}
