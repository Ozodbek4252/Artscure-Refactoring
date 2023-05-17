<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Exceptions\Type\TypeStoreException;
use App\Exceptions\Type\TypeUpdateException;

use Illuminate\Support\Facades\DB;

use App\Interfaces\TypeRepositoryInterface;
use App\Interfaces\TypeServiceInterface;

use App\Models\Type;
use App\Traits\UtilityTrait;

class TypeService implements TypeServiceInterface
{
    use UtilityTrait;
    public $attributes;
    public $type;
    public $image;

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
        // $typeData = $request->all();
        // return $this->typeRepository->create($typeData);
    }

    public function getTypeBySlug($slug)
    {
        $type = $this->typeRepository->find($slug);
        $type->views += 1;
        $type->save();
        return $type;
    }

    public function updateType(Request $request, $typeId)
    {
        // $typeData = $request->all();
        // return $this->typeRepository->update($typeId, $typeData);
    }

    public function deleteType($typeId)
    {
        // return $this->typeRepository->delete($typeId);
    }

    // public function __construct($request, $type = null)
    // {
    //     $this->attributes = $request->only(['name_uz', 'name_ru', 'name_en', 'category_id']);
    //     $this->image = $request->image;
    //     $this->type = $type;
    // }

    /**
     * @throws TypeStoreException
     */
    // public function store()
    // {
    //     DB::beginTransaction();
    //     try {
    //         $this->attributes['slug'] = str_replace(' ', '_', strtolower($this->attributes['name_uz'])).'-'.Str::random(5);

    //         $this->type = Type::create($this->attributes);

    //         // store image using UtilityTrait
    //         $this->storeImage($this->image, $this->type, 'Type', 'types');
    //     } catch (\Exception $exception) {
    //         DB::rollBack();
    //         throw new TypeStoreException("Cannot store. Error:{$exception->getMessage()}");
    //     }
    //     DB::commit();

    //     return $this;
    // }

    // public function update()
    // {
    //     DB::beginTransaction();
    //     try {
    //         $this->type->update($this->attributes);

    //         if($this->image != null) {
    //             // delete old image using UtilityTrait
    //             $this->deleteImages($this->type->images);

    //             // store image using UtilityTrait
    //             $this->storeImage($this->image, $this->type, 'Type', 'types');
    //         }
    //     } catch (\Exception $exception) {
    //         DB::rollBack();
    //         throw new TypeUpdateException("Cannot update. Error:{$exception->getMessage()}");
    //     }
    //     DB::commit();

    //     return $this;
    // }

}
