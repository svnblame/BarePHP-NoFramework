<?php

namespace Core;

class Response
{
    const OK = 200;
    const OK_MSG = "OK";


    const UNAUTHORIZED = 401;
    const UNAUTHORIZED_MSG = "Unauthorized";

    const FORBIDDEN = 403;
    const FORBIDDEN_MSG = "Forbidden";

    const NOT_FOUND = 404;
    const NOT_FOUND_MSG = "Not Found";

    const SERVICE_UNAVAILABLE = 503;
    const SERVICE_UNAVAILABLE_MSG = "Service Unavailable";

    public static function getMessage(int $code): string
    {
        return match ($code) {
            self::OK => self::OK_MSG,
            self::NOT_FOUND => self::NOT_FOUND_MSG,
            self::UNAUTHORIZED => self::UNAUTHORIZED_MSG,
            self::FORBIDDEN => self::FORBIDDEN_MSG,
            self::SERVICE_UNAVAILABLE => self::SERVICE_UNAVAILABLE_MSG,
            default => "Unknown error",
        };
    }
}
