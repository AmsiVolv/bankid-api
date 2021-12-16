<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\Provider;

use Amsi\Libs\BankId\Cipher\CipherInterface;
use Amsi\Libs\BankId\Cipher\EUSign;
use Amsi\Libs\BankId\Client;
use Amsi\Libs\BankId\Exceptions\BankIdDecodeError;
use Amsi\Libs\BankId\Exceptions\BankIdRequestError;
use Amsi\Libs\BankId\Exceptions\BankIdWrongResponseTypeError;
use Amsi\Libs\BankId\Response\ResponseParamsInterface;
use JsonException;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BankID
 * @package Amsi\Libs\BankId\Provider
 */
class BankID extends AbstractProvider implements ResponseParamsInterface
{
    use BearerAuthorizationTrait;

    private CipherInterface $cipher;

    public function __construct(private Client $client, array $collaborators = [],)
    {
        parent::__construct($client->toArray(), $collaborators);

        $this->cipher = new EUSign($this->client);
    }

    public function getBaseAuthorizationUrl(): string
    {
        return $this->client->getConfig()->getBaseAuthorizationUrl();
    }

    public function getBaseAccessTokenUrl(array $params): string
    {
        return $this->client->getConfig()->getBaseAccessTokenUrl();
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        return $this->client->getConfig()->getResourceOwnerDetailsUrl();
    }

    public function getCipher(): CipherInterface
    {
        return $this->cipher;
    }

    protected function getDefaultScopes(): array
    {
        return [];
    }

    /**
     * @param AccessToken $token
     * @return array
     * @throws BankIdWrongResponseTypeError
     * @throws IdentityProviderException
     */
    protected function fetchResourceOwnerDetails(AccessToken $token): array
    {
        $url = $this->getResourceOwnerDetailsUrl($token);

        $request = $this->getAuthenticatedRequest(self::METHOD_POST, $url, $token, ResourceOwnerDetails::prepareResourceOwnerDetailRequest($this->client->getCert()));
        $response = $this->getParsedResponse($request);

        if (!is_array($response)) {
            throw new BankIdWrongResponseTypeError();
        }

        return $response;
    }

    /**
     * @param ResponseInterface $response
     * @param array $data
     * @return void
     * @throws BankIdRequestError
     */
    protected function checkResponse(ResponseInterface $response, $data): void
    {
        if (array_key_exists(self::ERROR_PARAM, $data) && $data[self::ERROR_PARAM] !== []) {
            throw new BankIdRequestError($data[self::ERROR_PARAM]);
        }
    }

    /**
     * @param array $response
     * @param AccessToken $token
     * @return ExpandedResourceOwnerInterface
     * @throws BankIdDecodeError
     * @throws JsonException
     */
    protected function createResourceOwner(array $response, AccessToken $token): ExpandedResourceOwnerInterface
    {
        $decoded = [
            self::MEMBER_ID_PARAM => $response[self::MEMBER_ID_PARAM],
            self::SID_BI_PARAM => $response[self::SID_BI_PARAM],
            self::DATA_PARAM => json_decode(
                $this->cipher->decode(
                    $response[self::CUSTOMER_CRYPTO_PARAM],
                    $response[self::CERT_PARAM]
                ),
                true,
                512,
                JSON_THROW_ON_ERROR
            ),
        ];

        return new BankIDResourceOwner($decoded);
    }
}
