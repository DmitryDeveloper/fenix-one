<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

/**
 * Interface EmailService
 * @package App\Contracts
 */
interface EmailService
{
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
    ): JsonResponse;
}
