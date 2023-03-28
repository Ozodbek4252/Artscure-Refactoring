<?php

namespace App\Repositories;

use App\Interfaces\HelpRepositoryInterface;
use App\Models\Help;

class HelpRepository implements HelpRepositoryInterface
{
    public function getAll($perPage = 20)
    {
        return Help::orderBy('updated_at', 'desc')->paginate($perPage);
    }

    public function create(array $data): Help
    {
        return Help::create($data);
    }

    public function delete(int $id): bool
    {
        return Help::find($id)->delete();
    }
}
