<?php

namespace KTS\src\Core;

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

    public static function getMessage(int $code): string
    {
        return match ($code) {
            self::OK => self::OK_MSG,
            self::NOT_FOUND => self::NOT_FOUND_MSG,
            self::UNAUTHORIZED => self::UNAUTHORIZED_MSG,
            self::FORBIDDEN => self::FORBIDDEN_MSG,
            default => "Unknown error",
        };
    }
}
