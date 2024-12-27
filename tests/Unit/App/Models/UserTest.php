<?php

namespace Tests\Unit\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class UserTest extends ModelTestCase
{

    protected function model(): User
    {
        return new User();
    }

    protected function traitsExpected(): array
    {
        return [
            HasFactory::class,
            Notifiable::class,
        ];
    }


    protected function fillableExpected(): array
    {
        return [
            'name',
            'email',
            'password',
        ];
    }

    protected function castsExpected(): array
    {
        return [
            'id' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
