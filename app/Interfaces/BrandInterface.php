<?php

namespace App\Interfaces;


interface BrandInterface
{
    public function create($request);

    public function edit($request);

    public function all();

    public function show($brandId);

    public function delete($brandId);



}
