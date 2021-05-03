<?php namespace App\Repositories;

interface CategoryRepositoryInterface{
	
	public function getParent();

	public function getCategory($id);

	// more
}