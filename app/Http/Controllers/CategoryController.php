<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create(Request $request)
    {
        $create = $this->categoryService->create($request);
        if (!$create['status']) {
            return ResponseHelper::badRequest($create['message']);
        }
        return ResponseHelper::success('Operation successful');
    }

    public function edit(Request $request)
    {
        $edit = $this->categoryService->edit($request);
        if (!$edit['status']) {
            return ResponseHelper::badRequest($edit['message']);
        }
        return ResponseHelper::success('Operation successful');
    }

    public function show($categoryId)
    {
        $category = $this->categoryService->show($categoryId);
        if (!$category['status']) {
            return ResponseHelper::badRequest($category['message']);
        }
        return ResponseHelper::success('Operation successful', $category['message']);
    }

    public function delete($categoryId)
    {
        $category = $this->categoryService->delete($categoryId);
        if (!$category['status']) {
            return ResponseHelper::badRequest($category['message']);
        }
        return ResponseHelper::success('Operation successful', $category['message']);
    }

    public function all()
    {
        $categories = $this->categoryService->all();
        if (!$categories['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $categories['message']);
    }

    public function adminAll()
    {
        $categories = $this->categoryService->adminAll();
        if (!$categories['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $categories['message']);
    }


    public function allWithoutSub()
    {
        if (Cache::has('all_brands_without_subs')) {
            $categories = Cache::get('all_brands_without_subs');
            return ResponseHelper::success('Operation successful', $categories['message']);
        }

        $categories = $this->categoryService->allWithoutSub();

        if (!$categories['status']) {
            return ResponseHelper::badRequest("fail");
        }

        Cache::put('all_brands_without_subs', $categories);

        return ResponseHelper::success('Operation successful', $categories['message']);
    }
}
