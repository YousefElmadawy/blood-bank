<?php

namespace App\Interfaces;



interface CategoryRepositoryInterface
{

    public function allCategories();
    public function createOne($request);
    public function updateOne($request, $id);
    public function removeOne($id);
}
