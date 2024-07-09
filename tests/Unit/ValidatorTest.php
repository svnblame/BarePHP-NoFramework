<?php

use Core\Validator;

it('validates a string', function () {
    expect(Validator::string('foobar', 1, 10))->toBeTrue()
        ->and(Validator::string(false, 1, 10))->toBeFalse()
        ->and(Validator::string('', 1, 10))->toBeFalse();
});

it('validates a string with a minimum length limit', function () {
    expect(Validator::string('foobar', 1, 10))->toBeTrue()
        ->and(Validator::string('foobar-foobaz', 1, 10))->toBeFalse()
        ->and(Validator::string('foobar', 7, 10))->toBeFalse();
});

it('validates an email address', function () {
    expect(Validator::email('foobar'))->toBeFalse()
        ->and(Validator::email(''))->toBeFalse()
        ->and(Validator::email('foobar@test.com'))->toBe('foobar@test.com');
});

it('validates that a number is greater than a given value', function () {
    expect(Validator::greaterThan(10, 1))->toBeTrue()
        ->and(Validator::greaterThan(1, 10))->toBeFalse();
});
