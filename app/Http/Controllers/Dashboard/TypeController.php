<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;

use App\Interfaces\TypeServiceInterface;

use App\Models\Category;

use App\Traits\UtilityTrait;

class TypeController extends Controller
{
    use UtilityTrait;

    protected $typeService;

    public function __construct(TypeServiceInterface $typeService)
    {
        $this->typeService = $typeService;
    }

    public function index()
    {
        $types = $this->typeService->getAllTypes();
        return view('dashboard.type.index', ['types' => $types]);
    }

    public function create()
    {
        $categories = Category::orderBy('updated_at', 'desc')->get();
        return view('dashboard.type.create', ['categories' => $categories]);
    }

    public function store(TypeRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->typeService->createType($request);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors($exception->getMessage());
        }
        DB::commit();
        return redirect()->route('types.index');
    }

    public function edit($slug)
    {
        $type = $this->typeService->getTypeBySlug($slug);
        $categories = Category::orderBy('updated_at', 'desc')->get();
        return view('dashboard.type.edit', [
            'type' => $type,
            'categories' => $categories
        ]);
    }

    public function update(TypeRequest $request, $slug)
    {
        DB::beginTransaction();
        try {
            $this->typeService->updateType($request, $slug);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors($exception->getMessage());
        }
        DB::commit();

        return redirect()->route('types.index');
    }

    public function destroy($slug)
    {
        DB::beginTransaction();
        try {
            $this->typeService->deleteType($slug);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors($exception->getMessage());
        }
        DB::commit();

        return redirect()->route('types.index');
    }
}
