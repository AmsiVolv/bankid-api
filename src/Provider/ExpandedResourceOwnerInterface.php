<?php

namespace Amsi\Libs\BankId\Provider;

use Amsi\Libs\BankId\ParsedResponse\ParsedPersonalData;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

/**
 * Interface  ExpandedResourceOwnerInterface
 * @package Amsi\Libs\BankId\Provider
 */
interface ExpandedResourceOwnerInterface extends ResourceOwnerInterface
{
    public function getId(): string;

    public function toArray(): array;

    public function getSidBi(): string;

    public function getPersonalData(): ParsedPersonalData;

    public function getScansData(): array;

    public function getAddressesData(): array;

    public function getDocumentsData(): array;
}
