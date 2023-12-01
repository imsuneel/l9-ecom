<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param  array  $attributes
     */
    public function store($attributes = []): ?bool
    {
        $userData = $this->makeUserData($attributes);

        $success = DB::transaction(function () use ($userData) {
            User::create($userData);

            return true;
        });

        return $success ? true : false;
    }

    /**
     * @return array
     */
    private function makeUserData($attributes)
    {

        return [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => bcrypt($attributes['password']),
        ];
    }
}
