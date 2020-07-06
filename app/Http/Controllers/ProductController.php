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

    public function homePage()
    {
        $products = $this->productService->homePage();
        if (! $products['status']) {
            return ResponseHelper::badRequest($products['message']);
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function all()
    {
        $products = $this->productService->all();
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function active()
    {
        $products = $this->productService->active();
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function show($productId)
    {
        $products = $this->productService->show($productId);
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function delete($productId)
    {
        $products = $this->productService->delete($productId);
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function brand($brandId)
    {
        $products = $this->productService->brand($brandId);
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function category($categoryId)
    {
        $products = $this->productService->category($categoryId);
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function subCategory($subCategoryId)
    {
        $products = $this->productService->subCategory($subCategoryId);
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function featured()
    {
        $products = $this->productService->featured();
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function hot()
    {
        $products = $this->productService->hot();
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function bestSellers()
    {
        $products = $this->productService->bestSeller();
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function new()
    {
        $products = $this->productService->new();
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }

    public function landingPage()
    {
        $products = $this->productService->landingPage();
        if (! $products['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $products['message']);
    }


}
