<?php

class Response
{
    const int OK = 200;
    const string OK_MSG = "OK";


    const int UNAUTHORIZED = 401;
    const string UNAUTHORIZED_MSG = "UNAUTHORIZED";

    const int FORBIDDEN = 403;
    const string FORBIDDEN_MSG = "FORBIDDEN";

    const int NOT_FOUND = 404;
    const string NOT_FOUND_MSG = "NOT_FOUND";

    public static function getMessage(int $code): string
    {
        return match ($code) {
            self::OK => "OK",
            self::NOT_FOUND => "Not Found",
            self::UNAUTHORIZED => "UNAUTHORIZED",
            self::FORBIDDEN => "FORBIDDEN",
            default => "UNKNOWN",
        };
    }
}
