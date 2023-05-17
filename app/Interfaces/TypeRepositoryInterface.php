<?php

namespace App\Interfaces;

use App\Models\Type;

interface TypeRepositoryInterface
{
    public function getAll();

    public function create(array $data): Type;

    public function find(string $slug): ?Type;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
