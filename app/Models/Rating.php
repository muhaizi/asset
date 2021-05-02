<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    

    //The first argument passed to the hasManyThrough method is the name of the final model we wish to access, 
    //while the second argument is the name of the intermediate model.

    /****
     * return $this->hasManyThrough(
            Deployment::class,
            Environment::class,
            'project_id', // Foreign key on the environments table...
            'environment_id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'id' // Local key on the environments table...
        );
     * https://stitcher.io/blog/laravel-has-many-through
     * https://github.com/staudenmeir/eloquent-has-many-deep
     * country -> user -> Post
     * 
     * $country = Country::find(1);	
        dd($country->posts);
     */
    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Question::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
