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

    public function create($request)
    {
       return $this->category->create($request);
    }

    public function edit($request)
    {
       return $this->category->where('category_id', $request['category_id'])->update(['name' => $request['name']]);
    }

    public function all()
    {
       return $this->category ? $this->category->with('subCategories')->paginate(20) : false;
    }

    public function show($category_id)
    {
       return $this->category->where('category_id', $category_id)->with('subCategories')->first();
    }

    // sub categories
    public function createSub($request)
    {
       return $this->subCategory->create($request);
    }

    public function editSub($request)
    {
       return $this->subCategory->where('sub_category_id', $request['sub_category_id'])->update(['name' => $request['name']]);
    }

    public function allSub()
    {
       return $this->subCategory ? $this->subCategory->paginate(20) : false;
    }
}
