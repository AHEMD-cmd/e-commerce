<?php

namespace App\Services\Dashboard;

use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\CategoryRepository;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    protected $categoryRespository;
    public function __construct(CategoryRepository $categoryRespository)
    {
        $this->categoryRespository = $categoryRespository;
    }
    public function getCategories()
    {
        return $this->categoryRespository->getAll();
    }

    public function getCategoriesForDatatable()
    {
        $categories = $this->categoryRespository->getAll();

        return DataTables::of($categories)
        ->addIndexColumn()
        ->addColumn('name', function ($category) {
            return $category->getTranslation('name', app()->getLocale());
        })
        ->addColumn('status' , function ($category){
            return $category->getStatusTranslated();
        })
        ->addColumn('products_count' , function($category){
            return $category->products()->count() == 0 ? __('dashboard.not_found') : $category->products()->count();
        })
        ->addColumn('actions', function ($category) {
           return view('dashboard.categories.actions'  ,compact('category'));
        })

        ->make(true);
    }

    public function store($data)
    {
        return $this->categoryRespository->store($data);
    }
    public function findById($id)
    {
        return $this->categoryRespository->findById($id);
    }

    public function update($data)
    {
        $category = $this->categoryRespository->findById($data['id']);
        if(!$category){
            return false;
        }
        return $this->categoryRespository->update($category , $data);
    }
    public function delete($id)
    {
        $category = $this->categoryRespository->findById($id);
        return $this->categoryRespository->delete($category);
    }

    public function getParentCategories()
    {
        return $this->categoryRespository->getParentCategories();
    }



    public function getCategoriesExceptChildren($id)
    {
        return $this->categoryRespository->getCategoriesExceptChildren($id);
    }


}
