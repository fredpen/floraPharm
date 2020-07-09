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

    public function edit($id, $request)
    {
        return $this->product->find($id)->update($request);
    }



    public function all()
    {
        return $this->product ? $this->product->with(['category', 'subCategory', 'brand'])->orderBy('updated_at', 'desc')->paginate(20) : [];
    }

    public function active()
    {
        return $this->product ? $this->product->where('status', 1)->with(['category', 'subCategory', 'brand'])->orderBy('updated_at', 'desc')->paginate(20) : false;
    }

    public function show($productId)
    {
        return $this->product->where('id', $productId)->with(['category', 'subCategory', 'brand'])->first();
    }

    public function delete($productId)
    {
        return $this->product->where('id', $productId)->delete();
    }

    public function brand($brandId)
    {
        $products = $this->product->where('brand_id', $brandId);
        return $products->count() ? $products->with(['category', 'brand'])->orderBy('updated_at', 'desc')->paginate(20) : [];
    }

    public function category($categoryId)
    {
        $products = $this->product->where('category_id', $categoryId);
        return $products->count() ? $products->with(['category', 'brand'])->orderBy('updated_at', 'desc')->paginate(20) : [];
    }

    public function subCategory($subCategoryId)
    {
        $products = $this->product->where('sub_category_id', $subCategoryId);
        return $products->count() ? $products->with(['category', 'brand'])->orderBy('updated_at', 'desc')->paginate(20) : [];
    }

    public function featured()
    {
        $products = $this->product->where('featured', 1);
        return $products->count() ? $products->with(['category', 'brand'])->orderBy('updated_at', 'desc')->paginate(20) : [];
    }

    public function hot()
    {
        $products = $this->product->where('hot', 1);
        return $products->count() ? $products->with(['category', 'brand'])->orderBy('updated_at', 'desc')->paginate(20) : [];
    }

    public function homePage()
    {
        $products = [];
        // $products['bestSeller'] = $this->fetchWithLimit('best_seller');
        $products['new'] = $this->fetchWithLimit('new');
        $products['landingPage'] = $this->fetchWithLimit('landing_page');
        $products['hot'] = $this->fetchWithLimit('hot');
        $products['featured'] = $this->fetchWithLimit('featured');
        return $products;
    }

    private function fetchWithLimit($queryString, $limit = 10)
    {
        return $this->product->where([$queryString => 1, 'status' => 1])->limit($limit)->get();
    }

    public function bestSeller()
    {
        $products = $this->product->where('best_seller', 1);
        return $products->count() ? $products->with(['category', 'brand'])->orderBy('updated_at', 'desc')->paginate(20) : [];
    }

    public function new()
    {
        $products = $this->product->where('new', 1);
        return $products->count() ? $products->with(['category', 'brand'])->orderBy('updated_at', 'desc')->paginate(20) : [];
    }

    public function landingPage()
    {
        $products = $this->product->where('landing_page', 1);
        return $products->count() ? $products->with(['category', 'subCategory', 'brand'])->orderBy('updated_at', 'desc')->paginate(20) : [];
    }

    public function filterProducts($request)
    {
        $brandsId = $request->brand_ids;
        $category_ids = $request->category_ids;
        $quantity = $request->quantity ? $request->quantity : 30;

        $products = $this->product->where('status', 1)->where(function ($query) use ($category_ids, $brandsId) {
            if ($category_ids && count($category_ids)) {
                $query->whereIntegerInRaw('category_id', $category_ids);
            }
            if ($brandsId && count($brandsId)) {
                $query->whereIntegerInRaw('brand_id', $brandsId);
            }
        });
        return $products->paginate($quantity);
    }
}
