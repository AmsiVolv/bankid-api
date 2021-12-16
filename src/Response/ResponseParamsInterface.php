<?php

namespace Amsi\Libs\BankId\Response;

/**
 * Interface ResponseParamsInterface
 * @package Amsi\Libs\BankId\Exceptions
 */
interface ResponseParamsInterface
{
    public const ERROR_PARAM = 'error';
    public const MEMBER_ID_PARAM = 'memberId';
    public const SID_BI_PARAM = 'sidBi';
    public const DATA_PARAM = 'data';
    public const CUSTOMER_CRYPTO_PARAM = 'customerCrypto';
    public const CERT_PARAM = 'cert';

    public const TYPE_PARAM = 'type';
    public const FIELDS_PARAM = 'fields';
    public const ADDRESSES_PARAM = 'addresses';
    public const DOCUMENTS_PARAM = 'documents';
    public const SCANS_PARAM = 'scans';

    public const TYPE_PHYSICAL_VALUE = 'physical';
    public const TYPE_FACTUAL_VALUE = 'factual';
    public const TYPE_PASSPORT_VALUE = 'passport';

    // Base request fields
    public const FIRST_NAME_PARAM = 'firstName';
    public const MIDDLE_NAME_PARAM = 'middleName';
    public const LAST_NAME_PARAM = 'lastName';
    public const PHONE_PARAM = 'phone';
    public const INN_PARAM = 'inn';
    public const BIRTH_DAY_PARAM = 'birthDay';
    public const SEX_PARAM = 'sex';

    // Addresses fields
    public const COUNTRY_PARAM = 'country';
    public const STATE_PARAM = 'state';
    public const AREA_PARAM = 'area';
    public const CITY_PARAM = 'city';
    public const STREET_PARAM = 'street';
    public const HOUSE_NO_PARAM = 'houseNo';
    public const FLAT_NO_PARAM = 'flatNo';

    // Passport fields
    public const SERIES_PARAM = 'series';
    public const NUMBER_PARAM = 'number';
    public const ISSUE_PARAM = 'issue';
    public const DATE_ISSUE_PARAM = 'dateIssue';
    public const DATE_EXPIRATION_PARAM = 'dateExpiration';
    public const ISSUE_COUNTRY_ISO_2_PARAM = 'issueCountryIso2';

    // Scan fields
    public const SCAN_FILE_PARAM = 'scanFile';
    public const DATE_CREATE_PARAM = 'dateCreate';
    public const EXTENSION_PARAM = 'extension';
}
