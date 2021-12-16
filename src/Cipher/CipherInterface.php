<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\Cipher;

/**
 * Interface CipherInterface
 * @package Amsi\Libs\BankId\Cipher
 */
interface CipherInterface
{
    public function decode(string $data, string $cert): string;
}
