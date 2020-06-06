<?php


namespace App\Interfaces;


interface ProductInterface
{
    public function create($request);

    public function edit($request);

    public function all();

    public function show($categoryId);

}
