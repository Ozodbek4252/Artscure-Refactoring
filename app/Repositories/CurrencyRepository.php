<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Interfaces\CurrencyRepositoryInterface;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function getAll($perPage = 20)
    {
        return Currency::orderBy('updated_at', 'desc')->paginate($perPage);
    }

    public function create(array $data): Currency
    {
        return Currency::create($data);
    }

    public function find(int $id): ?Currency
    {
        return Currency::find($id);
    }

    public function update(int $id, array $data): bool
    {
        return Currency::find($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Currency::find($id)->delete();
    }
}
