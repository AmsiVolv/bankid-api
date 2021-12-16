<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId;

use Amsi\Libs\BankId\Exceptions\BankIdException;

/**
 * Class Config
 * @package Amsi\Libs\BankId
 */
class Config
{
    public const ENV_TEST = 'test';
    public const ENV_PROD = 'prod';

    private const ENV_TEST_URL = 'https://testid.bank.gov.ua';
    private const ENV_PROD_URL = 'https://id.bank.gov.ua';

    private const BASE_AUTHORIZATION_URL = '/v1/bank/oauth2/authorize';
    private const BASE_ACCESS_TOKEN_URL = '/v1/bank/oauth2/token';
    private const RESOURCE_OWNER_DETAILS_URL = '/v1/bank/resource/client';

    private const SUPPORTED_ENV = [
        self::ENV_TEST,
        self::ENV_PROD,
    ];

    public function __construct(
        private string $env = self::ENV_PROD,
    ) {
        if (!in_array($env, self::SUPPORTED_ENV, true)) {
            throw new BankIdException(sprintf('Environment [%s] is not supported!', $env));
        }
    }

    public function getBaseAuthorizationUrl(): string
    {
        return sprintf('%s%s', $this->getApiUrl(), self::BASE_AUTHORIZATION_URL);
    }

    public function getBaseAccessTokenUrl(): string
    {
        return sprintf('%s%s', $this->getApiUrl(), self::BASE_ACCESS_TOKEN_URL);
    }

    public function getResourceOwnerDetailsUrl(): string
    {
        return sprintf('%s%s', $this->getApiUrl(), self::RESOURCE_OWNER_DETAILS_URL);
    }

    public function getApiUrl(): string
    {
        return match ($this->env) {
            self::ENV_TEST => self::ENV_TEST_URL,
            self::ENV_PROD => self::ENV_PROD_URL,
            default => throw new BankIdException(sprintf('Bad environment [%s]!', $this->env)),
        };
    }
}
