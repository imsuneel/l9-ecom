<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function store($attributes = []): ?bool;
}
