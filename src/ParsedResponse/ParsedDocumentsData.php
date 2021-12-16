<?php
declare(strict_types=1);

namespace Amsi\Libs\BankId\ParsedResponse;

use Amsi\Libs\BankId\Response\ResponseParamsInterface;

/**
 * Class ParsedDocumentsData
 * @package Amsi\Libs\BankId\ParsedResponse
 */
class ParsedDocumentsData implements ResponseParamsInterface
{
    private string $type;
    private string $series;
    private string $number;
    private string $issue;
    private string $dateIssue;
    private string $dateExpiration;
    private string $issueCountryIso2;

    public function __construct(array $data,)
    {
        $this->type = $data[self::TYPE_PARAM];
        $this->series = $data[self::SERIES_PARAM];
        $this->number = $data[self::NUMBER_PARAM];
        $this->issue = $data[self::ISSUE_PARAM];
        $this->dateIssue = $data[self::DATE_ISSUE_PARAM];
        $this->dateExpiration = $data[self::DATE_EXPIRATION_PARAM];
        $this->issueCountryIso2 = $data[self::ISSUE_COUNTRY_ISO_2_PARAM];
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSeries(): string
    {
        return $this->series;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getIssue(): string
    {
        return $this->issue;
    }

    public function getDateIssue(): string
    {
        return $this->dateIssue;
    }

    public function getDateExpiration(): string
    {
        return $this->dateExpiration;
    }

    public function getIssueCountryIso2(): string
    {
        return $this->issueCountryIso2;
    }
}
