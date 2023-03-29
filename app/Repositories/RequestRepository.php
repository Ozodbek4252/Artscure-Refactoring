<?php

namespace App\Repositories;

use App\Models\Request;
use App\Interfaces\RequestRepositoryInterface;

class RequestRepository implements RequestRepositoryInterface
{
    public function getAll($perPage = 20)
    {
        return Request::orderBy('updated_at', 'desc')->paginate($perPage);
    }

    public function create(array $data): Request
    {
        return Request::create($data);
    }

    public function find(int $id): ?Request
    {
        return Request::find($id);
    }

    public function delete(int $id): bool
    {
        $request = Request::find($id);

        if ($request && file_exists($request->portfolio)) {
            unlink($request->portfolio);
        }

        return $request->delete();
    }
}
