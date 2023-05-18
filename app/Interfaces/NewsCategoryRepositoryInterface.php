<?php

namespace App\Interfaces;

use App\Models\NewsCategory;

interface NewsCategoryRepositoryInterface
{
    public function getAll();

    public function create(array $data): NewsCategory;

    public function findById(int $id): ?NewsCategory;

    public function update(NewsCategory $newsCategory, array $data): ?NewsCategory;

    public function delete(int $id): bool;
}
