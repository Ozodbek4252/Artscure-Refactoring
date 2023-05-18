<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Interfaces\TypeRepositoryInterface;
use App\Interfaces\TypeServiceInterface;

use App\Traits\UtilityTrait;

class TypeService implements TypeServiceInterface
{
    use UtilityTrait;

    protected $typeRepository;

    public function __construct(TypeRepositoryInterface $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function getAllTypes($perPage = 20)
    {
        return $this->typeRepository->getAll($perPage);
    }

    public function createType(Request $request)
    {
        $slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);
        $attributes = $request->except(['image']);
        $attributes['slug'] = $slug;

        $type = $this->typeRepository->create($attributes);

        $this->storeImage($request->image, $type, 'Type', 'types');

        return $type;
    }

    public function getTypeBySlug($slug)
    {
        $type = $this->typeRepository->findBySlug($slug);
        $type->views += 1;
        $type->save();
        return $type;
    }

    public function updateType(Request $request, $slug)
    {
        $type = $this->typeRepository->findBySlug($slug);
        if (!$type) {
            throw new ModelNotFoundException('User not found');
        }

        $new_slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);
        $attributes = $request->only(['name_uz', 'name_ru', 'name_en', 'category_id']);
        $attributes['slug'] = $new_slug;

        $type = $this->typeRepository->update($type, $attributes);

        if ($request->image) {
            $this->deleteImages($type->images);
            $this->storeImage($request->image, $type, 'Type', 'types');
        }

        return $type;
    }

    public function deleteType($slug)
    {
        $type = $this->typeRepository->findBySlug($slug);

        $this->deleteImages($type->images);

        $this->setNullToArtistId($type->products);

        return $this->typeRepository->delete($type);
    }
}
