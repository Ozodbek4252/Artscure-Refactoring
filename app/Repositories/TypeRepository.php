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

    public function find(string $slug): ?Type
    {
        return Type::where('slug', $slug)->first();
    }

    public function update(int $id, array $data): bool
    {
        return Type::find($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Type::find($id)->delete();
    }
}
