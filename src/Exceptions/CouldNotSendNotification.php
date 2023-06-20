<?php

namespace Forss\Laravel\Notifications\ForssSms\Exceptions;

use Exception;
use GuzzleHttp\Exception\GuzzleException;

class CouldNotSendNotification extends Exception
{
   
    const CONNECTION_FAILED = 'Could not connect to sms provider: %s: %s';
    const ERROR_RESPONSE = 'SMS Server Failed with response: %s';

    public static function connectionFailed(GuzzleException $exception)
    {
        return new static(
            sprintf(self::CONNECTION_FAILED, $exception->getCode(), $exception->getMessage())
        );
    }

    public static function errorResponseFromServer($message)
    {
        return new static(
            sprintf(self::ERROR_RESPONSE, $message)
        );
    }
}