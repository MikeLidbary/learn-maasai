<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numbers =[
            ["One","Nabo","A,B,C","B","question.png","answer.png"],
            ["Two","Are","D,E,F","F","question.png","answer.png"],
            ["Three","Uni","G,H,I","G","question.png","answer.png"],
            ["Four","Ong'uan","J,K,L","J","question.png","answer.png"],
            ["Five","Imiet","M,N,O","N","question.png","answer.png"],
            ["Six","Ile","P,Q,R","Q","question.png","answer.png"],
            ["Seven","Naapishana","S,T,U","S","question.png","answer.png"],
            ["Eight","Isiet","V,W,X","X","question.png","answer.png"],
            ["Nine","Naaudo","Y,Z,AA","Z","question.png","answer.png"],
            ["Ten","Tomon","AB,AC,AD","AB","question.png","answer.png"]
        ];
        
        foreach($numbers as $number){
            $question = new Question();
            $question->english_word =$number[0];
            $question->maasai_word =$number[1];
            $question->question_image =$number[4];
            $question->answer_image =$number[5];
            $question->choice_pull =$number[2];
            $question->right_choice =$number[3];
            $question->save();
        }
    }
}
