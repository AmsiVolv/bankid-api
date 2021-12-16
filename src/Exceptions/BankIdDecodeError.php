<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\Exceptions;

use Exception;

/**
 * Class BankIdDecodeError
 * @package Amsi\Libs\BankId\Exceptions
 */
class BankIdDecodeError extends Exception implements BankIdExceptionInterface
{
    private const EXTENDED_MESSAGE = 'Original message [%s], EUSPHPE message [%s], EUSPHPE code [%d]';

    private const EU_ERROR_NOT_INITIALIZED_ID = 1;
    private const EU_ERROR_NOT_INITIALIZED_MSG = 'EU_ERROR_NOT_INITIALIZED';
    private const EU_ERROR_BAD_PARAMETER_ID = 2;
    private const EU_ERROR_BAD_PARAMETER_MSG = 'EU_ERROR_BAD_PARAMETER';
    private const EU_ERROR_LIBRARY_LOAD_ID = 3;
    private const EU_ERROR_LIBRARY_LOAD_MSG = 'EU_ERROR_LIBRARY_LOAD';
    private const EU_ERROR_READ_SETTINGS_ID = 4;
    private const EU_ERROR_READ_SETTINGS_MSG = 'EU_ERROR_READ_SETTINGS_MSG';
    private const EU_ERROR_TRANSMIT_REQUEST_ID = 5;
    private const EU_ERROR_TRANSMIT_REQUEST_MSG = 'EU_ERROR_TRANSMIT_REQUEST';
    private const EU_ERROR_MEMORY_ALLOCATION_ID = 6;
    private const EU_ERROR_MEMORY_ALLOCATION_MSG = 'EU_ERROR_MEMORY_ALLOCATION';
    private const EU_WARNING_END_OF_ENUM_ID = 7;
    private const EU_WARNING_END_OF_ENUM_MSG = 'EU_WARNING_END_OF_ENUM';
    private const EU_ERROR_PROXY_NOT_AUTHORIZED_ID = 8;
    private const EU_ERROR_PROXY_NOT_AUTHORIZED_MSG = 'EU_ERROR_PROXY_NOT_AUTHORIZED';
    private const EU_ERROR_NO_GUI_DIALOGS_ID = 9;
    private const EU_ERROR_NO_GUI_DIALOGS_MSG = 'EU_ERROR_NO_GUI_DIALOGS';
    private const EU_ERROR_DOWNLOAD_FILE_ID = 10;
    private const EU_ERROR_DOWNLOAD_FILE_MSG = 'EU_ERROR_DOWNLOAD_FILE';

    private const EU_ERROR_KEY_MEDIAS_FAILED_ID = 11;
    private const EU_ERROR_KEY_MEDIAS_FAILED_MSG = 'EU_ERROR_KEY_MEDIAS_FAILED';
    private const EU_ERROR_KEY_MEDIAS_ACCESS_FAILED_ID = 12;
    private const EU_ERROR_KEY_MEDIAS_ACCESS_FAILED_MSG = 'EU_ERROR_KEY_MEDIAS_ACCESS_FAILED';
    private const EU_ERROR_KEY_MEDIAS_READ_FAILED_ID = 13;
    private const EU_ERROR_KEY_MEDIAS_READ_FAILED_MSG = 'EU_ERROR_KEY_MEDIAS_READ_FAILED';
    private const EU_ERROR_KEY_MEDIAS_WRITE_FAILED_ID = 14;
    private const EU_ERROR_KEY_MEDIAS_WRITE_FAILED_MSG = 'EU_ERROR_KEY_MEDIAS_WRITE_FAILED';
    private const EU_WARNING_KEY_MEDIAS_READ_ONLY_ID = 15;
    private const EU_WARNING_KEY_MEDIAS_READ_ONLY_MSG = 'EU_WARNING_KEY_MEDIAS_READ_ONLY';
    private const EU_ERROR_KEY_MEDIAS_DELETE_ID = 16;
    private const EU_ERROR_KEY_MEDIAS_DELETE_MSG = 'EU_ERROR_KEY_MEDIAS_DELETE';
    private const EU_ERROR_KEY_MEDIAS_CLEAR_ID = 17;
    private const EU_ERROR_KEY_MEDIAS_CLEAR_MSG = 'EU_ERROR_KEY_MEDIAS_CLEAR';
    private const EU_ERROR_BAD_PRIVATE_KEY_ID = 18;
    private const EU_ERROR_BAD_PRIVATE_KEY_MSG = 'EU_ERROR_BAD_PRIVATE_KEY';
    private const EU_ERROR_PKI_FORMATS_FAILED_ID = 21;
    private const EU_ERROR_PKI_FORMATS_FAILED_MSG = 'EU_ERROR_PKI_FORMATS_FAILED';
    private const EU_ERROR_CSP_FAILED_ID = 22;
    private const EU_ERROR_CSP_FAILED_MSG = 'EU_ERROR_CSP_FAILED';
    private const EU_ERROR_BAD_SIGNATURE_ID = 23;
    private const EU_ERROR_BAD_SIGNATURE_MSG = 'EU_ERROR_BAD_SIGNATURE';
    private const EU_ERROR_AUTH_FAILED_ID = 24;
    private const EU_ERROR_AUTH_FAILED_MSG = 'EU_ERROR_AUTH_FAILED';
    private const EU_ERROR_NOT_RECEIVER_ID = 25;
    private const EU_ERROR_NOT_RECEIVER_MSG = 'EU_ERROR_NOT_RECEIVER';
    private const EU_ERROR_STORAGE_FAILED_ID = 31;
    private const EU_ERROR_STORAGE_FAILED_MSG = 'EU_ERROR_STORAGE_FAILED';
    private const EU_ERROR_BAD_CERT_ID = 32;
    private const EU_ERROR_BAD_CERT_MSG = 'EU_ERROR_BAD_CERT';
    private const EU_ERROR_CERT_NOT_FOUND_ID = 33;
    private const EU_ERROR_CERT_NOT_FOUND_MSG = 'EU_ERROR_CERT_NOT_FOUND';
    private const EU_ERROR_INVALID_CERT_TIME_ID = 34;
    private const EU_ERROR_INVALID_CERT_TIME_MSG = 'EU_ERROR_INVALID_CERT_TIME';
    private const EU_ERROR_CERT_IN_CRL_ID = 35;
    private const EU_ERROR_CERT_IN_CRL_MSG = 'EU_ERROR_CERT_IN_CRL';
    private const EU_ERROR_BAD_CRL_ID = 36;
    private const EU_ERROR_BAD_CRL_MSG = 'EU_ERROR_BAD_CRL';
    private const EU_ERROR_NO_VALID_CRLS_ID = 37;
    private const EU_ERROR_NO_VALID_CRLS_MSG = 'EU_ERROR_NO_VALID_CRLS';
    private const EU_ERROR_GET_TIME_STAMP_ID = 41;
    private const EU_ERROR_GET_TIME_STAMP_MSG = 'EU_ERROR_GET_TIME_STAMP';
    private const EU_ERROR_BAD_TSP_RESPONSE_ID = 42;
    private const EU_ERROR_BAD_TSP_RESPONSE_MSG = 'EU_ERROR_BAD_TSP_RESPONSE';
    private const EU_ERROR_TSP_SERVER_CERT_NOT_FOUND_ID = 43;
    private const EU_ERROR_TSP_SERVER_CERT_NOT_FOUND_MSG = 'EU_ERROR_TSP_SERVER_CERT_NOT_FOUND';
    private const EU_ERROR_TSP_SERVER_CERT_INVALID_ID = 44;
    private const EU_ERROR_TSP_SERVER_CERT_INVALID_MSG = 'EU_ERROR_TSP_SERVER_CERT_INVALID';
    private const EU_ERROR_GET_OCSP_STATUS_ID = 51;
    private const EU_ERROR_GET_OCSP_STATUS_MSG = 'EU_ERROR_GET_OCSP_STATUS';
    private const EU_ERROR_BAD_OCSP_RESPONSE_ID = 52;
    private const EU_ERROR_BAD_OCSP_RESPONSE_MSG = 'EU_ERROR_BAD_OCSP_RESPONSE';
    private const EU_ERROR_CERT_BAD_BY_OCSP_ID = 53;
    private const EU_ERROR_CERT_BAD_BY_OCSP_MSG = 'EU_ERROR_CERT_BAD_BY_OCSP';
    private const EU_ERROR_OCSP_SERVER_CERT_NOT_FOUND_ID = 54;
    private const EU_ERROR_OCSP_SERVER_CERT_NOT_FOUND_MSG = 'EU_ERROR_OCSP_SERVER_CERT_NOT_FOUND';
    private const EU_ERROR_OCSP_SERVER_CERT_INVALID_ID = 55;
    private const EU_ERROR_OCSP_SERVER_CERT_INVALID_MSG = 'EU_ERROR_OCSP_SERVER_CERT_INVALID';
    private const EU_ERROR_LDAP_ERROR_ID = 61;
    private const EU_ERROR_LDAP_ERROR_MSG = 'EU_ERROR_LDAP_ERROR';

    private const DEFAULT_DESCRIPTION = '%d -> Error code not specified';

    public static function create(?string $message = '', ?int $externalCode = null): BankIdExceptionInterface
    {
        if ($externalCode) {
            $externalCodeDescription = match ($externalCode) {
                self::EU_ERROR_NOT_INITIALIZED_ID => self::EU_ERROR_NOT_INITIALIZED_MSG,
                self::EU_ERROR_BAD_PARAMETER_ID => self::EU_ERROR_BAD_PARAMETER_MSG,
                self::EU_ERROR_LIBRARY_LOAD_ID => self::EU_ERROR_LIBRARY_LOAD_MSG,
                self::EU_ERROR_READ_SETTINGS_ID => self::EU_ERROR_READ_SETTINGS_MSG,
                self::EU_ERROR_TRANSMIT_REQUEST_ID => self::EU_ERROR_TRANSMIT_REQUEST_MSG,
                self::EU_ERROR_MEMORY_ALLOCATION_ID => self::EU_ERROR_MEMORY_ALLOCATION_MSG,
                self::EU_WARNING_END_OF_ENUM_ID => self::EU_WARNING_END_OF_ENUM_MSG,
                self::EU_ERROR_PROXY_NOT_AUTHORIZED_ID => self::EU_ERROR_PROXY_NOT_AUTHORIZED_MSG,
                self::EU_ERROR_NO_GUI_DIALOGS_ID => self::EU_ERROR_NO_GUI_DIALOGS_MSG,
                self::EU_ERROR_DOWNLOAD_FILE_ID => self::EU_ERROR_DOWNLOAD_FILE_MSG,
                self::EU_ERROR_KEY_MEDIAS_FAILED_ID => self::EU_ERROR_KEY_MEDIAS_FAILED_MSG,
                self::EU_ERROR_KEY_MEDIAS_ACCESS_FAILED_ID => self::EU_ERROR_KEY_MEDIAS_ACCESS_FAILED_MSG,
                self::EU_ERROR_KEY_MEDIAS_READ_FAILED_ID => self::EU_ERROR_KEY_MEDIAS_READ_FAILED_MSG,
                self::EU_ERROR_KEY_MEDIAS_WRITE_FAILED_ID => self::EU_ERROR_KEY_MEDIAS_WRITE_FAILED_MSG,
                self::EU_WARNING_KEY_MEDIAS_READ_ONLY_ID => self::EU_WARNING_KEY_MEDIAS_READ_ONLY_MSG,
                self::EU_ERROR_KEY_MEDIAS_DELETE_ID => self::EU_ERROR_KEY_MEDIAS_DELETE_MSG,
                self::EU_ERROR_KEY_MEDIAS_CLEAR_ID => self::EU_ERROR_KEY_MEDIAS_CLEAR_MSG,
                self::EU_ERROR_BAD_PRIVATE_KEY_ID => self::EU_ERROR_BAD_PRIVATE_KEY_MSG,
                self::EU_ERROR_PKI_FORMATS_FAILED_ID => self::EU_ERROR_PKI_FORMATS_FAILED_MSG,
                self::EU_ERROR_CSP_FAILED_ID => self::EU_ERROR_CSP_FAILED_MSG,
                self::EU_ERROR_BAD_SIGNATURE_ID => self::EU_ERROR_BAD_SIGNATURE_MSG,
                self::EU_ERROR_AUTH_FAILED_ID => self::EU_ERROR_AUTH_FAILED_MSG,
                self::EU_ERROR_NOT_RECEIVER_ID => self::EU_ERROR_NOT_RECEIVER_MSG,
                self::EU_ERROR_STORAGE_FAILED_ID => self::EU_ERROR_STORAGE_FAILED_MSG,
                self::EU_ERROR_BAD_CERT_ID => self::EU_ERROR_BAD_CERT_MSG,
                self::EU_ERROR_CERT_NOT_FOUND_ID => self::EU_ERROR_CERT_NOT_FOUND_MSG,
                self::EU_ERROR_INVALID_CERT_TIME_ID => self::EU_ERROR_INVALID_CERT_TIME_MSG,
                self::EU_ERROR_CERT_IN_CRL_ID => self::EU_ERROR_CERT_IN_CRL_MSG,
                self::EU_ERROR_BAD_CRL_ID => self::EU_ERROR_BAD_CRL_MSG,
                self::EU_ERROR_NO_VALID_CRLS_ID => self::EU_ERROR_NO_VALID_CRLS_MSG,
                self::EU_ERROR_GET_TIME_STAMP_ID => self::EU_ERROR_GET_TIME_STAMP_MSG,
                self::EU_ERROR_BAD_TSP_RESPONSE_ID => self::EU_ERROR_BAD_TSP_RESPONSE_MSG,
                self::EU_ERROR_TSP_SERVER_CERT_NOT_FOUND_ID => self::EU_ERROR_TSP_SERVER_CERT_NOT_FOUND_MSG,
                self::EU_ERROR_TSP_SERVER_CERT_INVALID_ID => self::EU_ERROR_TSP_SERVER_CERT_INVALID_MSG,
                self::EU_ERROR_GET_OCSP_STATUS_ID => self::EU_ERROR_GET_OCSP_STATUS_MSG,
                self::EU_ERROR_BAD_OCSP_RESPONSE_ID => self::EU_ERROR_BAD_OCSP_RESPONSE_MSG,
                self::EU_ERROR_CERT_BAD_BY_OCSP_ID => self::EU_ERROR_CERT_BAD_BY_OCSP_MSG,
                self::EU_ERROR_OCSP_SERVER_CERT_NOT_FOUND_ID => self::EU_ERROR_OCSP_SERVER_CERT_NOT_FOUND_MSG,
                self::EU_ERROR_OCSP_SERVER_CERT_INVALID_ID => self::EU_ERROR_OCSP_SERVER_CERT_INVALID_MSG,
                self::EU_ERROR_LDAP_ERROR_ID => self::EU_ERROR_LDAP_ERROR_MSG,
                default => sprintf(self::DEFAULT_DESCRIPTION, $externalCode)
            };

            $message = sprintf(self::EXTENDED_MESSAGE, $message, $externalCodeDescription, $externalCode);
        }

        return new BankIdException($message ?? '');
    }
}
