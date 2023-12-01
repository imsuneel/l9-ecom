<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function setUser(User $user): void;

    public function summary($attributes = []): array;

    public function all($attributes = [], $all = false): LengthAwarePaginator|Collection;

    public function create($attributes = []): bool;
}
