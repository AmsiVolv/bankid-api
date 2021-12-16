<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId;

/**
 * Class Client
 * @package Amsi\Libs\BankId
 */
class Client
{
    private const CLIENT_ID = 'clientId';
    private const CLIENT_SECRET = 'clientSecret';
    private const REDIRECT_URI = 'redirectUri';
    private const HOST = 'host';
    private const CERT = 'cert';
    private const KEY = 'key';
    private const PASSWORD = 'password';

    private string $host;

    public function __construct(
        private string $clientId,
        private string $clientSecret,
        private string $redirectUri,
        private string $cert,
        private string $key,
        private string $password,
        private Config $config,
    ) {
        $this->host = $this->config->getApiUrl();
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    public function getCert(): string
    {
        return $this->cert;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function toArray(): array
    {
        return [
          self::CLIENT_ID => $this->clientId,
          self::CLIENT_SECRET => $this->clientSecret,
          self::REDIRECT_URI => $this->redirectUri,
          self::HOST => $this->host,
          self::CERT => $this->cert,
          self::KEY => $this->key,
          self::PASSWORD => $this->password,
        ];
    }
}
