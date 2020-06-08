<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create(Request $request)
    {
        $create = $this->productService->create($request);
        if (! $create['status']) {
            return ResponseHelper::badRequest($create['message']);
        }
        return ResponseHelper::success('Operation successful');
    }

    public function edit(Request $request)
    {
        $edit = $this->productService->edit($request);
        if (! $edit['status']) {
            return ResponseHelper::badRequest($edit['message']);
        }
        return ResponseHelper::success('Operation successful');
    }

    public function all()
    {
        $categories = $this->productService->all();
        if (! $categories['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $categories['message']);
    }


}
