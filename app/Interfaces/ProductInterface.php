<?php


namespace App\Interfaces;


interface ProductInterface
{
    public function create($request);

    public function edit($id, $request);

    public function all($admin = false);

    public function active();

    public function filterProducts($request);

    public function homePage();

    public function show($productId);

    public function search($searchTerm);

    public function delete($productId);

    public function brand($brandId, $admin = false);

    public function category($categoryId, $admin = false);

    public function subCategory($subCategoryId);

    public function featured();

    public function hot();

    public function bestSeller();

    public function new();

    public function landingPage();

}
