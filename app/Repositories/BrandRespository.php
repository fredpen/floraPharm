<?php


namespace App\Repositories;

use App\Interfaces\BrandInterface;
use App\Models\Brand;

class BrandRespository implements BrandInterface
{
    protected $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function create($request)
    {
       return $this->brand->create($request);
    }

    public function edit($request)
    {
       return $this->brand->where('id', $request['id'])->update(['name' => $request['name']]);
    }

    public function all()
    {
       return $this->brand ? $this->brand->with('subCategory')->paginate(20) : false;
    }

    public function show($category_id)
    {
       return $this->brand->where('id', $category_id)->with('subCategory')->first();
    }
}
