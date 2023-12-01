<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Interfaces\UserRepositoryInterface;

class RegisterController extends Controller
{
    /**
     * RegisterController constructor.
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function store(UserStoreRequest $request)
    {
        $attributes = $request->all();

        $user = $this->userRepository->store($attributes);
        if ($user) {
            return response()->success(['message' => trans('auth.register')]);
        }

        return response()->error(['message' => trans('system.error')]);

    }
}
