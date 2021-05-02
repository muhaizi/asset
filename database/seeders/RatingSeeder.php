<?php

namespace Database\Seeders;

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
        \App\Models\Rating::factory(30)->create()->each(function($rating) {

            $question = \App\Models\Question::make();
        
            $answer = \App\Models\Answer::create([
                'question_id' => $question
            ]);
        
            $rating->entities()->save($answer);
        });
    }
}
