<?php
declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;

class UserInput
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetchUniversitiesByCountry(string $countryName, string $universityName = ''): UniversityCollection
    {
        $response = $this->client->get('http://universities.hipolabs.com/search', [
            'query' => [
                'country' => $countryName,
                'name' => $universityName,
            ]
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);
        $universityCollection = new UniversityCollection();

        if (isset($responseData[0]['alpha_two_code'])) {
            $alphaTwoCode = $responseData[0]['alpha_two_code'];
            $universityCollection->setAlphaTwoCode($alphaTwoCode);
        }

        foreach ($responseData as $universityData) {
            $university = new University(
                $universityData['name'],
                $universityData['country'],
                $universityData['web_pages'][0],
                $universityData['domains'][0]
            );
            $universityCollection->add($university);
        }

        return $universityCollection;
    }

    public function getUniversityListByCountry(): UniversityCollection
    {
        $input = readline("Enter country, to see the list of universities: ");
        return $this->fetchUniversitiesByCountry($input);
    }

    public function getOutputLayout(): void
    {
        $universitiesByCountry = $this->getUniversityListByCountry();

        foreach ($universitiesByCountry->getUniversities() as $university) {
            echo "Name: " . $university->getName() . "\n";
            echo "Country: " . $university->getCountry() . "\n";
            echo "Web Page: " . $university->getWebsite() . "\n";
            echo "-------------------------\n";
        }

        $wantsFacts = readline("\nWould you like to know some facts about " . $universitiesByCountry->getAlphaTwoCode() . "? (yes/no): ");

        if (strtolower($wantsFacts) === 'yes') {
            $countryFacts = new CountryFacts($universitiesByCountry);
            $countryFacts->display();
        }
    }
}