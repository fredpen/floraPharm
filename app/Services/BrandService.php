<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Interfaces\BrandInterface;
use Illuminate\Support\Facades\Validator;

class BrandService
{
    protected $brandInterface;

    public function __construct(BrandInterface $brandInterface)
    {
        $this->brandInterface = $brandInterface;
    }

    public function all()
    {
        $categories = $this->brandInterface->all();
        return $categories ? ResponseHelper::reply(true, $categories) : ResponseHelper::reply(false, "could not execute request");
    }

    public function delete($brandId)
    {
        $category = $this->brandInterface->delete($brandId);
        return $category ? ResponseHelper::reply(true, $category) : ResponseHelper::reply(false, "could not execute request - invalid brand ID");
    }

    public function show($brandId)
    {
        $category = $this->brandInterface->show($brandId);
        return $category ? ResponseHelper::reply(true, $category) : ResponseHelper::reply(false, "could not execute request");
    }

    public function create($request)
    {
        $validate = $this->validateCreateRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->brandInterface->create($request->only(['name', 'description']));
        return $create ? ResponseHelper::reply(true) : ResponseHelper::reply(false, "could not execute request");
    }

    public function edit($request)
    {
        $validate = $this->validateEditRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->brandInterface->edit($validate->valid());
        return $create ? ResponseHelper::reply(true) : ResponseHelper::reply(false, "could not execute request");
    }


    private function validateCreateRequest($request)
    {
        return Validator::make($request, [
            'name' => "required|string|unique:brand"
        ]);
    }

    private function validateEditRequest($request)
    {
        return Validator::make($request, [
            'id' => "required|integer|exists:brand",
            'name' => "required|string|unique:brand"
        ]);
    }


}
