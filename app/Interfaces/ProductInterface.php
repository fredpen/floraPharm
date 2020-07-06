<?php


namespace App\Interfaces;


interface ProductInterface
{
    public function create($request);

    public function edit($id, $request);

    public function all();

    public function active();

    public function homePage();

    public function show($productId);

    public function delete($productId);

    public function brand($brandId);

    public function category($categoryId);

    public function subCategory($subCategoryId);

    public function featured();

    public function hot();

    public function bestSeller();

    public function new();

    public function landingPage();

}
