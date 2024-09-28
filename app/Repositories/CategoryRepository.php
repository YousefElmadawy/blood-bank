<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
 
class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(public Category $category) {
        $this->category = $category;
    }
    public function allCategories()
    {
        return $this->category->all();
    }
    public function createOne($request)
    {

        return $this->category->create($request->all());
    }

    public function updateOne($request,$id)
    {
        $category= $this->category->find($id);
        return $category->update($request); 
    }
    public function removeOne($id)
    {
        $category= $this->category->find($id);
        return $category->delete(); 
    }
    
}
