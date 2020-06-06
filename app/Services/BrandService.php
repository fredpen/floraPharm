<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Interfaces\BrandInterface;
use Illuminate\Support\Facades\Validator;

class CategoryService
{
    //this is where i am now, if i get this right half of the project is doen
    // Am close but nothing is set yet, I need ti just link things together and make them work
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

    public function show($categoryId)
    {
        $category = $this->brandInterface->show($categoryId);
        return $category ? ResponseHelper::reply(true, $category) : ResponseHelper::reply(false, "could not execute request");
    }

    public function create($request)
    {
        $validate = $this->validateCreateRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->brandInterface->create($validate->valid());
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
