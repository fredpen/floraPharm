<?php

namespace App\Interfaces;


interface CategoryInterface
{
    public function create($request);

    public function edit($request);

    public function all();

    public function delete($categoryId);

    public function show($categoryId);

    // sub categories
    public function createSub($category_id, $name);

    public function editSub($request);

    public function showSub($category_id);

    public function deleteSub($category_id);

    public function allSub();
}
