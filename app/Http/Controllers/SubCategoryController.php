<?php

namespace App\Http\Controllers;

use App\Services\SubCategoryservice;

class SubCategoryController extends Controller
{
    protected $subCategoryservice;

    public function __construct(SubCategoryservice $subCategoryservice)
    {
        $this->subCategoryservice = $subCategoryservice;
    }


}
