<?php
declare(strict_types=1);

namespace App;

use Rinvex\Country\CountryLoader;

class CountryFacts
{

    private UniversityCollection $universityCollection;

    public function __construct(UniversityCollection $universityCollection)
    {
        $this->universityCollection = $universityCollection;
    }

    public function getFactsForCountry(): array
    {
        $country = country($this->universityCollection->getAlphaTwoCode());

        return [
            'officialName' => $country->getOfficialName(),
            'nativeName' => $country->getNativeName(),
            'capital' => $country->getCapital(),
            'languages' => $country->getLanguages(),
            'region' => $country->getRegion(),
        ];
    }

    public function display(): void
    {
        $details = $this->getFactsForCountry();

        echo "Official Name: " . $details['officialName'] . PHP_EOL;
        echo "Native Name: " . $details['nativeName'] . PHP_EOL;
        echo "Capital: " . $details['capital'] . PHP_EOL;
        echo "Languages: " . implode(', ', $details['languages']) . PHP_EOL;
        echo "Region: " . $details['region'] . PHP_EOL;
    }
}
