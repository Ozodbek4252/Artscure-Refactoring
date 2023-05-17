<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Interfaces\TypeServiceInterface;

use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;

use App\Traits\UtilityTrait;

use App\Models\Type;
use App\Models\Image;

class TypeController extends Controller
{
    use UtilityTrait;

    protected $typeService;

    public function __construct(TypeServiceInterface $typeService)
    {
        $this->typeService = $typeService;
    }


    public function index(Request $request)
    {
        try {
            $types = $this->typeService->getAllTypes($request->limit);
            return TypeResource::collection($types);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }


    // public function store(TypeRequest $request)
    // {
    //     $slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);

    //     $type = $request->except(['image']);
    //     $type['slug'] = $slug;

    //     $type = Type::create($type);

    //     $imageName = time() . '.' . $request->image->getClientOriginalExtension();
    //     $request->image->move(public_path('images/types'), $imageName);

    //     $image = new Image();
    //     $image->image = 'images/types/' . $imageName;
    //     $image->imageable_id = $type->id;
    //     $image->imageable_type = 'App\Models\Type';
    //     $image->save();

    //     if ($type) {
    //         return new TypeResource($type);
    //     } else {
    //         return response()->json([
    //             'message' => 'Error'
    //         ], 500);
    //     }
    // }

    public function show($slug)
    {
        try {
            $type = $this->typeService->getTypeBySlug($slug);
            if (!$type) {
                throw new ModelNotFoundException('User not found');
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return new TypeResource($type);
    }

    // public function update(TypeRequest $request, $slug)
    // {
    //     $new_slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);

    //     $type = Type::where('slug', $slug)->first();

    //     $type->name_uz = $request->name_uz;
    //     $type->name_ru = $request->name_ru;
    //     $type->name_en = $request->name_en;
    //     $type->category_id = $request->category_id;
    //     $type->slug = $new_slug;
    //     $result = $type->save();

    //     if ($request->image) {
    //         $this->deleteImages($type->images);
    //         $imageName = time() . '.' . $request->image->getClientOriginalExtension();
    //         $request->image->move(public_path('images/types'), $imageName);

    //         $image = new Image();
    //         $image->image = 'images/types/'.$imageName;
    //         $image->imageable_id = $type->id;
    //         $image->imageable_type = 'App\Models\Type';
    //         $image->save();
    //     }

    //     if ($result) {
    //         return response()->json(new TypeResource($type->refresh()), 200);
    //     } else {
    //         return response()->json([
    //             'message' => 'Error'
    //         ], 500);
    //     }
    // }

    // public function destroy($slug)
    // {
    //     $type = Type::where('slug', $slug)->first();

    //     $this->deleteImages($type->images);

    //     $this->setNullToArtistId($type->products);

    //     $result =  $type->delete();

    //     if ($result) {
    //         return response()->json([
    //             'message' => 'Deleted Successfully'
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'message' => 'Error'
    //         ], 500);
    //     }
    // }
}
