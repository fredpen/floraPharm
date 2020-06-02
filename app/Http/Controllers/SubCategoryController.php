<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\SubCategoryservice;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategoryservice;

    public function __construct(SubCategoryservice $subCategoryservice)
    {
        $this->subCategoryservice = $subCategoryservice;
    }

    public function create(Request $request)
    {
        $create = $this->subCategoryservice->create($request);
        if (! $create['status']) {
            return ResponseHelper::badRequest($create['message']);
        }
        return ResponseHelper::success('Operation successful', $create['message']);
    }

    public function show($subCategoryId)
    {
        $subCategory = $this->subCategoryservice->showSub($subCategoryId);
        if (! $subCategory['status']) {
            return ResponseHelper::badRequest($subCategory['message']);
        }
        return ResponseHelper::success('Operation successful', $subCategory['message']);
    }

    public function delete($subCategoryId)
    {
        $subCategory = $this->subCategoryservice->deleteSub($subCategoryId);
        if (! $subCategory['status']) {
            return ResponseHelper::badRequest($subCategory['message']);
        }
        return ResponseHelper::success('Operation successful', []);
    }


    public function edit(Request $request)
    {
        $edit = $this->subCategoryservice->edit($request);
        if (! $edit['status']) {
            return ResponseHelper::badRequest($edit['message']);
        }
        return ResponseHelper::success('Operation successful');
    }

    public function all()
    {
        $categories = $this->subCategoryservice->all();
        if (! $categories['status']) {
            return ResponseHelper::badRequest("fail");
        }
        return ResponseHelper::success('Operation successful', $categories['message']);
    }


}
