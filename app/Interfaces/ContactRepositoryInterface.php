<?php

namespace App\Interfaces;

use App\Models\Contact;

interface ContactRepositoryInterface
{
    public function getAll();

    public function create(array $data): Contact;

    public function delete(int $id): bool;
}
