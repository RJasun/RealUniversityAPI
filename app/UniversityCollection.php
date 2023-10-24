<?php
declare(strict_types=1);

namespace App;

class UniversityCollection
{
    private array $universities = [];
    private string $alphaTwoCode = '';

    public function add(University $university): void
    {
        $this->universities[] = $university;
    }

    public function getUniversities(): array
    {
        return $this->universities;
    }

    public function setAlphaTwoCode(string $code): void
    {
        $this->alphaTwoCode = $code;
    }

    public function getAlphaTwoCode(): string
    {
        return $this->alphaTwoCode;
    }
}