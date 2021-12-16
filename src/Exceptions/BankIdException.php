<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\Exceptions;

use Exception;

/**
 * Class BankIdException
 * @package Amsi\Libs\BankId\Exceptions
 */
class BankIdException extends Exception implements BankIdExceptionInterface
{
    public static function create(?string $message): BankIdExceptionInterface
    {
        return new BankIdException($message ?? '');
    }
}
