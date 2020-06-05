<?php


namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryRepository implements CategoryInterface
{
    protected $category;
    protected $subCategory;

    public function __construct(Category $category, SubCategory $subCategory)
    {
        $this->category = $category;
        $this->subCategory = $subCategory;
    }


}
