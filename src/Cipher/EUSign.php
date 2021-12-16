<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\Cipher;

use Amsi\Libs\BankId\Client;
use Amsi\Libs\BankId\Exceptions\BankIdDecodeError;
use Amsi\Libs\BankId\Exceptions\BankIdException;
use Amsi\Libs\BankId\Exceptions\BankIdExceptionInterface;
use stdClass;

/**
 * Class CipherInterface
 * @package Amsi\Libs\BankId\Cipher
 */
class EUSign implements CipherInterface
{
    private const ENCODING_UTF8 = 65001;
    private const EM_RESULT_OK = 0;
    private const EM_RESULT_ERROR = 1;
    private const EM_RESULT_ERROR_WRONG_PARAMS = 2;
    private const EM_RESULT_ERROR_INITIALIZED = 3;

    public function __construct(private Client $client)
    {
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param string $data
     * @param string $cert
     * @return string
     * @throws BankIdDecodeError
     * @throws BankIdException
     */
    public function decode(string $data, string $cert): string
    {
        $context = '';
        $keyContext = '';
        $errorCode = 0;
        $envelop = new stdClass;
        $signInfo = new stdClass;

        euspe_setcharset(self::ENCODING_UTF8);
        $this->verifyResult(euspe_init($errorCode), $errorCode);
        $this->verifyResult(euspe_ctxcreate($context, $errorCode), $errorCode);
        $this->verifyResult(
            euspe_ctxreadprivatekeybinary(
                $context,
                $this->client->getKey(),
                $this->client->getPassword(),
                $keyContext,
                $errorCode
            ),
            $errorCode
        );
        $this->verifyResult(
            euspe_ctxdevelopdata(
                $keyContext,
                base64_decode($data, true),
                base64_decode($cert, true),
                $envelop->data,
                $envelop->signTime,
                $envelop->useTSP,
                $envelop->issuer,
                $envelop->issuerCN,
                $envelop->serial,
                $envelop->subject,
                $envelop->subjCN,
                $envelop->subjOrg,
                $envelop->subjOrgUnit,
                $envelop->subjTitle,
                $envelop->subjState,
                $envelop->subjLocality,
                $envelop->subjFullName,
                $envelop->subjAddress,
                $envelop->subjPhone,
                $envelop->subjEMail,
                $envelop->subjDNS,
                $envelop->subjEDRPOUCode,
                $envelop->subjDRFOCode,
                $errorCode
            ),
            $errorCode
        );
        $this->verifyResult(
            euspe_signverify(
                $envelop->data,
                $signInfo->signTime,
                $signInfo->useTSP,
                $signInfo->issuer,
                $signInfo->issuerCN,
                $signInfo->serial,
                $signInfo->subject,
                $signInfo->subjCN,
                $signInfo->subjOrg,
                $signInfo->subjOrgUnit,
                $signInfo->subjTitle,
                $signInfo->subjState,
                $signInfo->subjLocality,
                $signInfo->subjFullName,
                $signInfo->subjAddress,
                $signInfo->subjPhone,
                $signInfo->subjEMail,
                $signInfo->subjDNS,
                $signInfo->subjEDRPOUCode,
                $signInfo->subjDRFOCode,
                $signInfo->data,
                $errorCode
            ),
            $errorCode
        );

        euspe_ctxfreeprivatekey($keyContext);
        euspe_ctxfree($context);
        euspe_finalize();

        return $signInfo->data;
    }

    /**
     * @param int $result
     * @param int $errorCode
     * @return void
     * @throws BankIdExceptionInterface
     */
    public function verifyResult(int $result, int $errorCode): void
    {
        match ($result) {
            self::EM_RESULT_OK => true,
            self::EM_RESULT_ERROR => throw BankIdDecodeError::create('Decode error', $errorCode),
            self::EM_RESULT_ERROR_WRONG_PARAMS => throw new BankIdDecodeError('Decode error: Wrong params'),
            self::EM_RESULT_ERROR_INITIALIZED => throw new BankIdDecodeError(
                'Decode error: Cipher initialization error'
            ),
            default => throw new BankIdException(sprintf('Undefiled result code [%d]', $result))
        };
    }
}
