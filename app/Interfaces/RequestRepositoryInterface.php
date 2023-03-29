<?php

namespace App\Interfaces;

use App\Models\Request;

interface RequestRepositoryInterface
{
    public function getAll();

    public function create(array $data): Request;

    public function find(int $id): ?Request;

    public function delete(int $id): bool;
}
