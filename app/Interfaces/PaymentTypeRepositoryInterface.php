<?php

namespace App\Interfaces;

use App\Models\PaymentType;

interface PaymentTypeRepositoryInterface
{
    public function getAll();

    public function create(array $data): PaymentType;

    public function find(int $id): ?PaymentType;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
