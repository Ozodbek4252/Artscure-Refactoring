<?php

namespace App\Repositories;

use App\Models\Type;
use App\Interfaces\TypeRepositoryInterface;

class TypeRepository implements TypeRepositoryInterface
{
    public function getAll($perPage = 20)
    {
        return Type::orderBy('updated_at', 'desc')->paginate($perPage);
    }

    public function create(array $data): Type
    {
        return Type::create($data);
    }

    public function findBySlug(string $slug): ?Type
    {
        return Type::where('slug', $slug)->first();
    }

    public function update(Type $type, array $data): ?Type
    {
        $type->update($data);
        return $type->refresh();
    }

    public function delete(Type $type): bool
    {
        return $type->delete();
    }
}
