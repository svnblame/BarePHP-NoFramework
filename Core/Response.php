<?php

namespace Core;

class Response
{
    const int OK = 200;
    const string OK_MSG = "OK";


    const int UNAUTHORIZED = 401;
    const string UNAUTHORIZED_MSG = "Unauthorized";

    const int FORBIDDEN = 403;
    const string FORBIDDEN_MSG = "Forbidden";

    const int NOT_FOUND = 404;
    const string NOT_FOUND_MSG = "Not Found";

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
