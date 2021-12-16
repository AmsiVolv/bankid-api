<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\Exceptions;

use Exception;

/**
 * Class BankIdWrongResponseTypeError
 * @package Amsi\Libs\BankId\Exceptions
 */
class BankIdWrongResponseTypeError extends Exception implements BankIdExceptionInterface
{
    private const MESSAGE = 'Invalid response received from Authorization Server. Expected JSON.';

    public static function create(?string $message = self::MESSAGE): BankIdExceptionInterface
    {
        return new BankIdException($message ?? self::MESSAGE);
    }
}
