<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;
use App\Contracts\EmailService as Service;

/**
 * Class EmailService
 * @package App\Services
 */
class EmailService implements Service
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
        try {
            Mail::raw($text, static function ($message) use ($from, $to, $subject) {
                $message->from($from, 'Laravel');
                $message->to($to);
                $message->subject($subject);
            });
            Log::info(self::SUCCESS . " from $from to $to");
            return response()->json(self::SUCCESS);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json($exception->getMessage());
        }
    }
}
