<?php

namespace App\Interfaces;

use App\Models\Type;

interface TypeRepositoryInterface
{
    public function getAll();

    public function create(array $data): Type;

    public function findBySlug(string $slug): ?Type;

    public function update(Type $type, array $data): ?Type;

    public function delete(Type $type): bool;
}
