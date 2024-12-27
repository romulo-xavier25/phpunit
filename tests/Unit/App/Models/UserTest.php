<?php

namespace Tests\Unit\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    protected function model(): Model
    {
        return new User();
    }

    public function testTraits(): void
    {
        $modelTraits = array_keys(class_uses($this->model()));
        $expected = [
            HasFactory::class,
            Notifiable::class,
        ];

        $this->assertEquals($expected, $modelTraits);
    }

    public function testFillable(): void
    {
        $fillable = $this->model()->getFillable();
        $expectedFillable = [
            'name',
            'email',
            'password',
        ];

        $this->assertEquals($expectedFillable, $fillable);
    }

    public function testIncrementingIsFalse(): void
    {
        $this->assertFalse($this->model()->getIncrementing());
    }

    public function testHasCasts(): void
    {
        $expectedCasts = [
            'id' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
        $casts = $this->model()->getCasts();

        $this->assertEquals($expectedCasts, $casts);
    }
}
