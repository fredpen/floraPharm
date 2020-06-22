<?php

namespace App\Services;

use App\Interfaces\CategoryInterface;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;

class CategoryService
{
    protected $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    public function all()
    {
        $categories = $this->categoryInterface->all();
        return $categories ? ResponseHelper::reply(true, $categories) : ResponseHelper::reply(false, "could not execute request");
    }

    public function allWithoutSub()
    {
        $categories = $this->categoryInterface->allWithoutSub();
        return $categories ? ResponseHelper::reply(true, $categories) : ResponseHelper::reply(false, "could not execute request");
    }


    public function show($categoryId)
    {
        $category = $this->categoryInterface->show($categoryId);
        return $category ? ResponseHelper::reply(true, $category) : ResponseHelper::reply(false, "could not execute request");
    }

    public function delete($categoryId)
    {
        $category = $this->categoryInterface->delete($categoryId);
        return $category ? ResponseHelper::reply(true, $category) : ResponseHelper::reply(false, "could not execute request - invalid category ID");
    }

    public function create($request)
    {
        $validate = $this->validateCreateRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->categoryInterface->create($validate->valid());
        return $create ? ResponseHelper::reply(true) : ResponseHelper::reply(false, "could not execute request");
    }

    public function edit($request)
    {
        $validate = $this->validateEditRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->categoryInterface->edit($validate->valid());
        return $create ? ResponseHelper::reply(true) : ResponseHelper::reply(false, "could not execute request");
    }


    private function validateCreateRequest($request)
    {
        return Validator::make($request, [
            'name' => "required|string|unique:category"
        ]);
    }

    private function validateEditRequest($request)
    {
        return Validator::make($request, [
            'id' => "required|integer|exists:category",
            'name' => "required|string|unique:category"
        ]);
    }


}
