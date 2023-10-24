<?php
declare(strict_types=1);

namespace App;
class University
{
    private string $name;
    private string $country;
    private string $domain;
    private string $website;

    public function __construct(string $name, string $country, string $domain, string $website)
    {
        $this->name = $name;
        $this->country = $country;
        $this->domain = $domain;
        $this->website = $website;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

}