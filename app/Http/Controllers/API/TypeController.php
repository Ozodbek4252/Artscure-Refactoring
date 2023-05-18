<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Interfaces\TypeServiceInterface;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;

use App\Traits\UtilityTrait;

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

    public function store(TypeRequest $request)
    {
        try {
            DB::beginTransaction();
            $type = $this->typeService->createType($request);
            DB::commit();
            return new TypeResource($type);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

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

    public function update(TypeRequest $request, $slug)
    {
        try {
            DB::beginTransaction();
            $type = $this->typeService->updateType($request, $slug);
            DB::commit();
            return response()->json(new TypeResource($type->refresh()), 200);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($slug)
    {
        try {
            DB::beginTransaction();
            $this->typeService->deleteType($slug);
            DB::commit();
            return response()->json('Deleted Successfully', 200);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
