<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

/**
 * Class MailgunService
 * @package App\Services
 */
class MailgunService
{
    public const SUCCESS = 'Message was sent Successfully';

    /**
     * $text    String with text your message
     * $from    Address from was sent message
     * $to      Address where was sent message
     * $subject Theme of message
     *
     * @param $text
     * @param $from
     * @param $to
     * @param $subject
     * @return JsonResponse
     */
    public static function sendMessage(
        string $text,
        string $from,
        string $to,
        string $subject
    ): JsonResponse {
        Mail::raw($text, function ($message) use ($from, $to, $subject) {
            $message->from($from, 'Laravel');
            $message->to($to);
            $message->subject($subject);
        });

        return response()->json(self::SUCCESS);
    }
}
