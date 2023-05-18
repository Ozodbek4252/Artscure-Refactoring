<?php

namespace App\Repositories;

use App\Models\NewsCategory;
use App\Interfaces\NewsCategoryRepositoryInterface;

class NewsCategoryRepository implements NewsCategoryRepositoryInterface
{
    public function getAll($perPage = 20)
    {
        return NewsCategory::orderBy('updated_at', 'desc')->paginate($perPage);
    }

    public function create(array $data): NewsCategory
    {
        return NewsCategory::create($data);
    }

    public function findById(int $id): ?NewsCategory
    {
        return NewsCategory::find($id);
    }

    public function update(NewsCategory $newsCategory, array $data): ?NewsCategory
    {
        $newsCategory->update($data);
        return $newsCategory->refresh();
    }

    public function delete(int $id): bool
    {
        return NewsCategory::find($id)->delete();
    }
}
