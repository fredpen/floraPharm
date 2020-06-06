<?php


namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function create($request)
    {
       return $this->product->create($request);
    }

    public function edit($request)
    {
       return $this->product->where('id', $request['id'])->update(['name' => $request['name']]);
    }

    public function all()
    {
       return $this->product ? $this->product->with('subCategory')->paginate(20) : false;
    }

    public function show($category_id)
    {
       return $this->product->where('id', $category_id)->with('subCategory')->first();
    }
}
