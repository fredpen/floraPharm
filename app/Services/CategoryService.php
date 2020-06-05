<?php

namespace App\Services;

use App\Interfaces\CategoryInterface;

class CategoryService
{
    protected $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }


}
