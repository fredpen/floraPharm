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

    public function create($request)
    {
        $validate = $this->validateCreateRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->productInterface->create($validate->valid());
        return $create ? ResponseHelper::reply(true) : ResponseHelper::reply(false, "could not execute request");
    }

    public function edit($request)
    {
        $validate = $this->validateEditRequest($request->all());
        if ($validate->fails()) {
            return ResponseHelper::reply(false, $validate->errors()->first());
        }

        $create = $this->productInterface->edit($request->id, $validate->valid());
        return $create ? ResponseHelper::reply(true) : ResponseHelper::reply(false, "could not execute request");
    }

    public function all()
    {
        $products = $this->productInterface->all();
        return $products ? ResponseHelper::reply(true, $products) : ResponseHelper::reply(false, "could not execute request");
    }

    public function active()
    {
        $products = $this->productInterface->active();
        return $products ? ResponseHelper::reply(true, $products) : ResponseHelper::reply(false, "could not execute request");
    }

    public function show($productId)
    {
        $product = $this->productInterface->show($productId);
        return $product ? ResponseHelper::reply(true, $product) : ResponseHelper::reply(false, "could not execute request");
    }

    public function delete($productId)
    {
        $product = $this->productInterface->delete($productId);
        return $product ? ResponseHelper::reply(true, $product) : ResponseHelper::reply(false, "could not execute request");
    }

    public function brand($brandId)
    {
        $product = $this->productInterface->brand($brandId);
        return $product ? ResponseHelper::reply(true, $product) : ResponseHelper::reply(false, "could not execute request");
    }

    public function category($categoryId)
    {
        $product = $this->productInterface->category($categoryId);
        return $product ? ResponseHelper::reply(true, $product) : ResponseHelper::reply(false, "could not execute request");
    }

    public function subCategory($subCategoryId)
    {
        $product = $this->productInterface->subCategory($subCategoryId);
        return $product ? ResponseHelper::reply(true, $product) : ResponseHelper::reply(false, "could not execute request");
    }

    public function featured()
    {
        $product = $this->productInterface->featured();
        return $product ? ResponseHelper::reply(true, $product) : ResponseHelper::reply(false, "could not execute request");
    }

    public function hot()
    {
        $product = $this->productInterface->hot();
        return $product ? ResponseHelper::reply(true, $product) : ResponseHelper::reply(false, "could not execute request");
    }

    public function bestSeller()
    {
        $product = $this->productInterface->bestSeller();
        return $product ? ResponseHelper::reply(true, $product) : ResponseHelper::reply(false, "could not execute request");
    }

    public function new()
    {
        $product = $this->productInterface->new();
        return $product ? ResponseHelper::reply(true, $product) : ResponseHelper::reply(false, "could not execute request");
    }

    public function landingPage()
    {
        $product = $this->productInterface->landingPage();
        return $product ? ResponseHelper::reply(true, $product) : ResponseHelper::reply(false, "could not execute request");
    }









    private function validateCreateRequest($request)
    {
        return Validator::make($request, [
            'category_id' => "required|integer|exists:category,id",
            'sub_category_id' => "required|integer|exists:sub_category,id",
            'brand_id' => "required|integer|exists:brand,id",
            'name' => "required|string|min:5",
            'quantity' => "required|integer|min:0",
            'description' => "required|string|min:10",
            'dosage' => "required|string",
            'price' => "required|numeric|min:1",
            'discount_price' => "required|numeric|min:1",
            'image_url' => "required|string",
            'status' => "required|boolean",
            'hot' => "required|boolean",
            'best_seller' => "required|boolean",
            'new' => "required|boolean",
            'landing_page' => "required|boolean",
        ]);
    }

    private function validateEditRequest($request)
    {
        return Validator::make($request, [
            'id' => "required|integer|exists:product",
            'category_id' => "integer|exists:category,id",
            'sub_category_id' => "integer|exists:sub_category,id",
            'brand_id' => "integer|exists:brand,id",
            'name' => "string|min:5",
            'quantity' => "integer|min:0",
            'description' => "string|min:10",
            'dosage' => "string|min:5",
            'price' => "numeric|min:1",
            'discount_price' => "numeric|min:1",
            'image_url' => "string",
            'status' => "boolean",
            'hot' => "boolean",
            'best_seller' => "boolean",
            'new' => "boolean",
            'landing_page' => "boolean",
        ]);
    }


}
