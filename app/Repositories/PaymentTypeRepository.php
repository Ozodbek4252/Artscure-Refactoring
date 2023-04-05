<?php

namespace App\Repositories;

use App\Models\PaymentType;
use App\Interfaces\PaymentTypeRepositoryInterface;

class PaymentTypeRepository implements PaymentTypeRepositoryInterface
{
    public function getAll($perPage = 20)
    {
        return PaymentType::orderBy('updated_at', 'desc')->paginate($perPage);
    }

    public function create(array $data): PaymentType
    {
        return PaymentType::create($data);
    }

    public function find(int $id): ?PaymentType
    {
        return PaymentType::find($id);
    }

    public function update(int $id, array $data): bool
    {
        return PaymentType::find($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return PaymentType::find($id)->delete();
    }
}
