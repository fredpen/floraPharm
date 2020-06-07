<?php

namespace App\Interfaces;


interface CategoryInterface
{
    public function create($request);

    public function edit($request);

    public function all();

    public function show($categoryId);

    // sub categories
    public function createSub($request);

    public function editSub($request);

    public function allSub();
}
