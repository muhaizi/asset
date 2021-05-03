<?php namespace App\Repositories;

use App\Models\Category;
//https://laravelarticle.com/repository-design-pattern-in-laravel
class CategoryRepository implements CategoryRepositoryInterface
{
	public function getParent(){
		
		return Category::query()
			->whereNull('category_id')
			->with('childCategories')
			->orderBy('title')
			->get();
	}

	public function getCategory($id){
		return Category::findOrFail($id);
	}

	// more 

}