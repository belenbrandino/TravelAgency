<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airline\Domain\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

class InvalidCityAirlineException extends HttpException
{
    public const ERROR_CODE = 'invalid_city_airline_exception';

    protected $status = JsonResponse::HTTP_BAD_REQUEST;

    protected $errorCode = self::ERROR_CODE;
}
