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
       return $this->category->where('id', $request['id'])->update(['name' => $request['name']]);
    }

    public function all()
    {
       return $this->category ? $this->category->with('subCategory')->paginate(20) : false;
    }

    public function show($category_id)
    {
       return $this->category->where('id', $category_id)->with('subCategory')->first();
    }

    // sub categories
    public function createSub($category_id, $name)
    {
       return $this->subCategory->create([
           'category_id' => $category_id,
           'name' => $name
       ]);
    }

    public function editSub($request)
    {
       return $this->subCategory->where('id', $request['id'])->update(['name' => $request['name']]);
    }

    public function allSub()
    {
       return $this->subCategory ? $this->subCategory->with('category')->paginate(20) : false;
    }
}
