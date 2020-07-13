<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Services\BrandService;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function create(Request $request)
    {
        $create = $this->brandService->create($request);
        if (! $create['status']) {
            return ResponseHelper::badRequest($create['message']);
        }
        return ResponseHelper::success('Operation successful', $create['message']);
    }

    public function show($brandId)
    {
        $subCategory = $this->brandService->show($brandId);
        if (! $subCategory['status']) {
            return ResponseHelper::badRequest($subCategory['message']);
        }
        return ResponseHelper::success('Operation successful', $subCategory['message']);
    }

    public function delete($brandId)
    {
        $subCategory = $this->brandService->delete($brandId);
        if (! $subCategory['status']) {
            return ResponseHelper::badRequest($subCategory['message']);
        }
        return ResponseHelper::success('Operation successful', []);
    }


    public function edit(Request $request)
    {
        $edit = $this->brandService->edit($request);
        if (! $edit['status']) {
            return ResponseHelper::badRequest($edit['message']);
        }
        return ResponseHelper::success('Operation successful');
    }

    public function all()
    {
        $categories = $this->brandService->all();
        if (! $categories['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $categories['message']);
    }

    public function adminAll()
    {
        $categories = $this->brandService->adminAll();
        if (! $categories['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $categories['message']);
    }
}
