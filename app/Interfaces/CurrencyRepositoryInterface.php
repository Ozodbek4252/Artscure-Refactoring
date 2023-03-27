<?php

namespace App\Interfaces;

use App\Models\Currency;

interface CurrencyRepositoryInterface
{
    public function getAll();

    public function create(array $data): Currency;

    public function find(int $id): ?Currency;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
