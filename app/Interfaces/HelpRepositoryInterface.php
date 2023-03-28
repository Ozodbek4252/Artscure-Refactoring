<?php

namespace App\Interfaces;

use App\Models\Help;

interface HelpRepositoryInterface
{
    public function getAll();

    public function create(array $data): Help;

    public function delete(int $id): bool;
}
