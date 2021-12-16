<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\ParsedResponse;

use Amsi\Libs\BankId\Response\ResponseParamsInterface;

/**
 * Class ParsedPersonalData
 * @package Amsi\Libs\BankId\ParsedResponse
 */
class ParsedPersonalData implements ResponseParamsInterface
{
    private string $type;
    private string $firstName;
    private string $middleName;
    private string $lastName;
    private string $phone;
    private string $inn;
    private string $birthDay;

    public function __construct(array $data,)
    {
        $this->type = $data[self::TYPE_PARAM];
        $this->firstName = $data[self::FIRST_NAME_PARAM];
        $this->middleName = $data[self::MIDDLE_NAME_PARAM];
        $this->lastName = $data[self::LAST_NAME_PARAM];
        $this->phone = $data[self::PHONE_PARAM];
        $this->inn = $data[self::INN_PARAM];
        $this->birthDay = $data[self::BIRTH_DAY_PARAM];
    }

    public function getType(): mixed
    {
        return $this->type;
    }

    public function getFirstName(): mixed
    {
        return $this->firstName;
    }

    public function getMiddleName(): mixed
    {
        return $this->middleName;
    }

    public function getLastName(): mixed
    {
        return $this->lastName;
    }

    public function getPhone(): mixed
    {
        return $this->phone;
    }

    public function getInn(): mixed
    {
        return $this->inn;
    }

    public function getBirthDay(): mixed
    {
        return $this->birthDay;
    }
}
