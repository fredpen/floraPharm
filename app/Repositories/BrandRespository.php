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
       return $this->brand->where('id', $request['id'])->update(['name' => $request['name'], 'status' => $request['status']]);
    }

    public function all($admin = false)
    {
        if ($admin) {
            return $this->brand ? $this->brand->orderBy('updated_at', 'Desc')->get() : false;
        }
       return $this->brand->where('status', 1) ? $this->brand->where('status', 1)->orderBy('updated_at', 'Desc')->get() : false;
    }

    public function show($brandId)
    {
       return $this->brand->where('id', $brandId)->first();
    }

    public function delete($brandId)
    {
       return $this->brand->where('id', $brandId)->delete();
    }
}
