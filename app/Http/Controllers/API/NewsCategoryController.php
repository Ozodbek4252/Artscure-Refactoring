<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Interfaces\NewsCategoryServiceInterface;

class NewsCategoryController extends Controller
{
    protected $newsCategoryService;

    public function __construct(NewsCategoryServiceInterface $newsCategoryService)
    {
        $this->newsCategoryService = $newsCategoryService;
    }

    public function index()
    {
        return $this->newsCategoryService->getAllNewsCategories();
    }
}
