<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\Provider;

use Amsi\Libs\BankId\ParsedResponse\ParsedAddressesData;
use Amsi\Libs\BankId\ParsedResponse\ParsedDocumentsData;
use Amsi\Libs\BankId\ParsedResponse\ParsedPersonalData;
use Amsi\Libs\BankId\ParsedResponse\ParsedScansData;
use Amsi\Libs\BankId\Response\ResponseParamsInterface;

/**
 * Class BankIDResourceOwner
 * @package Amsi\Libs\BankId\Provider
 */
class BankIDResourceOwner implements ExpandedResourceOwnerInterface, ResponseParamsInterface
{
    private string $id;
    private string $sidBi;

    private ParsedPersonalData $personalData;
    private array $scansData;
    private array $addressesData;
    private array $documentsData;

    public function __construct(private array $response = [])
    {
        $this->id = $this->response[self::MEMBER_ID_PARAM];
        $this->sidBi = $this->response[self::SID_BI_PARAM];

        $data = $this->response[self::DATA_PARAM];
        $addressesData = $data[self::ADDRESSES_PARAM];
        $scansData = $data[self::SCANS_PARAM];
        $documentsData = $data[self::DOCUMENTS_PARAM];

        $this->personalData = new ParsedPersonalData($data);
        $this->addressesData = $this->createOneToMany(ParsedAddressesData::class, $addressesData);
        $this->scansData = $this->createOneToMany(ParsedScansData::class, $scansData);
        $this->documentsData = $this->createOneToMany(ParsedDocumentsData::class, $documentsData);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSidBi(): string
    {
        return $this->sidBi;
    }

    public function getPersonalData(): ParsedPersonalData
    {
        return $this->personalData;
    }

    public function getScansData(): array
    {
        return $this->scansData;
    }

    public function getAddressesData(): array
    {
        return $this->addressesData;
    }

    public function getDocumentsData(): array
    {
        return $this->documentsData;
    }

    public function toArray(): array
    {
        return $this->response;
    }

    private function createOneToMany(string $typeToCreate, array $dataToParse): array
    {
        $initState = [];

        foreach ($dataToParse as $itemToParse) {
            $initState[] = new $typeToCreate($itemToParse);
        }

        return $initState;
    }
}
