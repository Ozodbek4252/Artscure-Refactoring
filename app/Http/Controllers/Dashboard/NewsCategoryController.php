<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCategoryRequest;

use App\Interfaces\NewsCategoryServiceInterface;

use App\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    protected $newsCategoryService;

    public function __construct(NewsCategoryServiceInterface $newsCategoryService)
    {
        $this->newsCategoryService = $newsCategoryService;
    }

    public function index()
    {
        $news_categories = $this->newsCategoryService->getAllNewsCategories();
        return view('dashboard.news.news-category.index', compact('news_categories'));
    }

    public function create()
    {
        return view('dashboard.news.news-category.create');
    }

    public function store(NewsCategoryRequest $request)
    {
        $this->newsCategoryService->createNewsCategory($request);
        return redirect()->route('newsCategory.index');
    }

    public function edit($id)
    {
        $news_category = $this->newsCategoryService->getNewsCategoryById($id);
        return view('dashboard.news.news-category.edit', compact('news_category'));
    }

    public function update(NewsCategoryRequest $request, $id)
    {
        $this->newsCategoryService->updateNewsCategory($request, $id);

        return redirect()->route('newsCategory.index');
    }

    public function destroy($id)
    {
        $this->newsCategoryService->deleteNewsCategory($id);
        return redirect()->route('newsCategory.index');
    }
}
