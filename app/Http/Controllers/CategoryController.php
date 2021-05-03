<?php

namespace App\Http\Controllers;
use App\Repositories\CategoryRepositoryInterface;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $repository;

	public function __construct(CategoryRepositoryInterface $repository)
	{
	   $this->repository = $repository;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->getParent();
        //dd($categories);
        //$data['categories'] = $categories;
        /***
         * 
         * [
            'categories' => $this->repository->getParent()
            ]
         */
        return view ('category.category', compact('categories'));
    }  
}
