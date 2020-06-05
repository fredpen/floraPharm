<?php

namespace App\Services;

use App\Interfaces\SubCategoryInterface;

class SubCategoryservice
{
    protected $subCategoryInterface;

    public function __construct(SubCategoryInterface $subCategoryInterface)
    {
        $this->subCategoryInterface = $subCategoryInterface;
    }


}
