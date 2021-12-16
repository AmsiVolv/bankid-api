<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\ParsedResponse;

use Amsi\Libs\BankId\Response\ResponseParamsInterface;

/**
 * Class ParsedScansData
 * @package Amsi\Libs\BankId\ParsedResponse
 */
class ParsedScansData implements ResponseParamsInterface
{
    private string $type;
    private string $scanFile;
    private string $dateCreate;
    private string $extension;

    public function __construct(array $data,)
    {
        $this->type = $data[self::TYPE_PARAM];
        $this->scanFile = $data[self::SCAN_FILE_PARAM];
        $this->dateCreate = $data[self::DATE_CREATE_PARAM];
        $this->extension = $data[self::EXTENSION_PARAM];
    }

    public function getType(): mixed
    {
        return $this->type;
    }

    public function getScanFile(): mixed
    {
        return $this->scanFile;
    }

    public function getDateCreate(): mixed
    {
        return $this->dateCreate;
    }

    public function getExtension(): mixed
    {
        return $this->extension;
    }
}
