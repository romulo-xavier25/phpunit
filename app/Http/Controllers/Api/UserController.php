<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $response = $this->repository->paginate();
        return UserResource::collection(collect($response->items()))
                            ->additional([
                                'meta' => [
                                    'total' => $response->total(),
                                    'per_page' => $response->perPage(),
                                    'current_page' => $response->currentPage(),
                                    'last_page' => $response->lastPage(),
                                ]
                            ]);
    }
}
