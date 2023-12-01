<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface CartRepositoryInterface
{
    public function setUser(User $user): void;

    public function all($attributes = []): Collection;

    public function delete($id, $attributes = []): bool;

    public function create($attributes = []): bool;

    public function update($id, $attributes = []): bool;
}
