<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Interfaces\CategoryInterface;
use Illuminate\Support\Facades\Validator;

class SubCategoryservice
{
    protected $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    public function all()
    {
        $categories = $this->categoryInterface->allSub();
        return $categories ? ResponseHelper::reply(true, $categories) : ResponseHelper::reply(false, "could not execute request");
    }

    public function create($request)
    {
        $validate = $this->validateCreateRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->categoryInterface->createSub($request->category_id, $request->name);
        return $create ? ResponseHelper::reply(true) : ResponseHelper::reply(false, "could not execute request");
    }

    public function showSub($sub_categoryId)
    {
        $subCategory = $this->categoryInterface->showSub($sub_categoryId);
        return $subCategory ? ResponseHelper::reply(true, $subCategory) : ResponseHelper::reply(false, "Invalid sub category id");
    }

    public function deleteSub($sub_categoryId)
    {
        $subCategory = $this->categoryInterface->deleteSub($sub_categoryId);
        return $subCategory ? ResponseHelper::reply(true, $subCategory) : ResponseHelper::reply(false, "could not execute request - invalid category ID");
    }

    public function edit($request)
    {
        $validate = $this->validateEditRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->categoryInterface->editSub($validate->valid());
        return $create ? ResponseHelper::reply(true) : ResponseHelper::reply(false, "could not execute request");
    }

    private function validateCreateRequest($request)
    {
        return Validator::make($request, [
            'name' => "required|string|unique:sub_category",
            'category_id'=> "required|integer|exists:category,id"
        ]);
    }

    private function validateEditRequest($request)
    {
        return Validator::make($request, [
            'id' => "required|integer|exists:sub_category",
            'name' => "required|string|unique:sub_category"
        ]);
    }
}
