<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\Provider;

use Amsi\Libs\BankId\Response\ResponseParamsInterface;

/**
 * ResourceOwnerDetails
 * @package Amsi\Libs\BankId\Provider
 */
class ResourceOwnerDetails implements ResponseParamsInterface
{
    private const FIELDS = [
        self::FIRST_NAME_PARAM,
        self::MIDDLE_NAME_PARAM,
        self::LAST_NAME_PARAM,
        self::PHONE_PARAM,
        self::INN_PARAM,
        self::BIRTH_DAY_PARAM,
        self::INN_PARAM,
    ];

    private const ADDRESSES = [
        [
            self::TYPE_PARAM => self::TYPE_FACTUAL_VALUE,
            self::FIELDS_PARAM => [
                self::COUNTRY_PARAM,
                self::STATE_PARAM,
                self::AREA_PARAM,
                self::CITY_PARAM,
                self::STREET_PARAM,
                self::HOUSE_NO_PARAM,
                self::FLAT_NO_PARAM,
            ],
        ],
    ];

    private const DOCUMENTS = [
        [
            self::TYPE_PARAM => self::TYPE_PASSPORT_VALUE,
            self::FIELDS_PARAM => [
                self::SERIES_PARAM,
                self::NUMBER_PARAM,
                self::ISSUE_PARAM,
                self::DATE_ISSUE_PARAM,
                self::DATE_EXPIRATION_PARAM,
                self::ISSUE_COUNTRY_ISO_2_PARAM,
            ],
        ],
    ];

    private const SCANS = [
        [
            self::TYPE_PARAM => self::TYPE_PASSPORT_VALUE,
            self::FIELDS_PARAM => [
                self::SCAN_FILE_PARAM,
                self::DATE_CREATE_PARAM,
                self::EXTENSION_PARAM,
            ],
        ],
    ];

    public static function prepareResourceOwnerDetailRequest(string $cert): array
    {
        return [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => self::getEncodedBody($cert),
        ];
    }

    private static function getBody(string $cert): array
    {
        return [
            self::CERT_PARAM => base64_encode($cert),
            self::TYPE_PARAM => self::TYPE_PHYSICAL_VALUE,
            self::FIELDS_PARAM => self::FIELDS,
            self::ADDRESSES_PARAM => self::ADDRESSES,
            self::DOCUMENTS_PARAM => self::DOCUMENTS,
            self::SCANS_PARAM => self::SCANS,
        ];
    }

    private static function getEncodedBody(string $cert): string
    {
        return json_encode(self::getBody($cert), JSON_THROW_ON_ERROR);
    }
}
