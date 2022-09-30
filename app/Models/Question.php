<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;

class Question extends Model
{
    use HasFactory;

    /**
     * Send whatsapp message
     * @param $to
     * @param $image_path
     * @return string
     */
    public static function send($to,$image_path){

        $from = config('services.twilio.whatsapp_number');

        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.auth_token'));

        return $twilio->messages->create('whatsapp:' . $to, [
            "from" => 'whatsapp:' . $from,
            "mediaUrl" => [$image_path],
            // "body" => $message->content
        ]);
    }

    /**
     * Fetch question based on learner's response
     * @param $to
     * @param $user_id
     * @return string
     */
    public static function fetchQuestion($response, $user_id)
    {
        $next_question = Question::select('question_image', 'id');

        if ($response == 'next') {

            $current_session = Session::where('user_id', $user_id)
                ->whereRaw('CURDATE(NOW()) = CURDATE("created_at")')
                ->pluck('question_id')->toArray();

            if ($current_session) {
                $next_question->whereNotIn('question_id', $current_session);
            }
        }

        $question = $next_question->inRandomOrder()->first();

        Session::logSession($user_id, $question->id);

        return $question->question_image;
    }
}
