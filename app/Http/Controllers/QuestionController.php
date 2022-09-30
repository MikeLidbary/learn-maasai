<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function reply(Request $request)
    {
        $response = trim($request->Body);
        $whatsapp_number = $request->From;
        $user = User::where('whatsapp_number', $whatsapp_number)->first();
        if (!$user) {
            $user = new User();
            $user->whatsapp_number = $whatsapp_number;
            $user->save();
        }

        if (strlen($response) == 1) {
            $question = Question::where('choice_pull', 'like', '%' . $response . '%')
                ->first();
            if ($question) {
                
                $path = 'wrong.png';

                if (strtolower($response)  == strtolower($question->right_choice)) {
                    Session::logSession($user->id, $question->id,true);
                    $path = $question->answer_image;
                }
            }
        } else {
            $path = Question::fetchQuestion($response, $user->id);
        }
        return Question::send($whatsapp_number, url('images/' . $path));
    }
}
