<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public static function logSession($user_id, $question_id,$status_update = false)
    {
        if($status_update){
            $session = Session::where('question_id',$question_id)->where('user_id',$user_id)->orderBy('id')->first();
            if($session){
                $session->status = 1;
                $session->save();
                return;
            }

        }

        $session = new Session();
        $session->user_id = $user_id;
        $session->question_id = $question_id;
        $session->save();
    }
}
