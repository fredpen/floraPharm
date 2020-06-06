<?php

namespace App\Services;

use App\Interfaces\ProductInterface;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    protected $productInterface;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }

    public function all()
    {
        $categories = $this->ProductInterface->all();
        return $categories ? ResponseHelper::reply(true, $categories) : ResponseHelper::reply(false, "could not execute request");
    }

    public function show($categoryId)
    {
        $category = $this->ProductInterface->show($categoryId);
        return $category ? ResponseHelper::reply(true, $category) : ResponseHelper::reply(false, "could not execute request");
    }

    public function create($request)
    {
        $validate = $this->validateCreateRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->ProductInterface->create($validate->valid());
        return $create ? ResponseHelper::reply(true) : ResponseHelper::reply(false, "could not execute request");
    }

    public function edit($request)
    {
        $validate = $this->validateEditRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->ProductInterface->edit($validate->valid());
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
