<?php

namespace App\Interfaces;

use App\Http\Requests\NewsCategoryRequest;

interface NewsCategoryServiceInterface
{
    public function getAllNewsCategories();

    public function createNewsCategory(NewsCategoryRequest $request);

    public function getNewsCategoryById($newsCategoryId);

    public function updateNewsCategory(NewsCategoryRequest $request, $newsCategoryId);

    public function deleteNewsCategory($newsCategoryId);
}
