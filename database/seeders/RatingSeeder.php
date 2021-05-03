<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            \App\Models\Rating::factory(10)->create()->each(function($rating) {

                $questions = \App\Models\Question::factory(10)->make();
        
                $rating->questions()->saveMany($questions)->make();
                
                $questions->each(function($question){

                    $answers = \App\Models\Answer::factory(10)->make();
                    
                    $question->answers()->saveMany($answers)->make();
                });
            });


    }

            //   php artisan db:seed
            //php artisan db:seed --class=UserSeeder

}
