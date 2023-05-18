<?php

namespace App\Services;

use App\Http\Requests\NewsCategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Interfaces\NewsCategoryRepositoryInterface;
use App\Interfaces\NewsCategoryServiceInterface;

use App\Traits\UtilityTrait;

class NewsCategoryService implements NewsCategoryServiceInterface
{
    use UtilityTrait;

    protected $newsCategoryRepository;

    public function __construct(NewsCategoryRepositoryInterface $newsCategoryRepository)
    {
        $this->newsCategoryRepository = $newsCategoryRepository;
    }

    public function getAllNewsCategories($perPage = 20)
    {
        return $this->newsCategoryRepository->getAll($perPage);
    }

    public function getNewsCategoryById($id)
    {
        return $this->newsCategoryRepository->findById($id);
    }

    public function createNewsCategory(NewsCategoryRequest $request)
    {
        $attributes = $request->only('name_uz', 'name_ru', 'name_en');

        return $this->newsCategoryRepository->create($attributes);
    }

    public function updateNewsCategory(NewsCategoryRequest $request, $id)
    {
        $newsCategory = $this->newsCategoryRepository->findById($id);
        $attributes = $request->only('name_uz', 'name_ru', 'name_en');

        return $this->newsCategoryRepository->update($newsCategory, $attributes);
    }

    public function deleteNewsCategory($id)
    {
        $newsCategory = $this->newsCategoryRepository->findById($id);
        if (count($newsCategory->news) > 0 ) {
            dd('bor');
        }
        dd('yoq');
        // $this->deleteImages($type->images);


        // $this->setNullToArtistId($type->products);

        // return $this->typeRepository->delete($type);
    }
}
