<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\ParsedResponse;

use Amsi\Libs\BankId\Response\ResponseParamsInterface;

/**
 * Class ParsedAddressesData
 * @package Amsi\Libs\BankId\ParsedResponse
 */
class ParsedAddressesData implements ResponseParamsInterface
{
    private string $type;
    private string $country;
    private string $state;
    private string $area;
    private string $city;
    private string $street;
    private string $houseNo;
    private string $flatNo;

    public function __construct(array $data,)
    {
        $this->type = $data[self::TYPE_PARAM];
        $this->country = $data[self::COUNTRY_PARAM];
        $this->state = $data[self::STATE_PARAM];
        $this->area = $data[self::AREA_PARAM];
        $this->city = $data[self::CITY_PARAM];
        $this->street = $data[self::STREET_PARAM];
        $this->houseNo = $data[self::HOUSE_NO_PARAM];
        $this->flatNo = $data[self::FLAT_NO_PARAM];
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getHouseNo(): string
    {
        return $this->houseNo;
    }

    public function getFlatNo(): string
    {
        return $this->flatNo;
    }
}
