<?php
namespace SearchApp\Client;

use GuzzleHttp\Client;
use SearchApp\SearchEngine\SearchEngine;
use SearchApp\SearchEngine\GoogleSearch;

class SearchClient
{
    private const SEARCH_ENGINE_GOOGLE = 'google';

    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function search(string $searchEngine, array $options): array
    {
        return $this->getSearchEngine($searchEngine)
            ->setHttpClient($this->httpClient)
            ->search($options);
    }

    public function getSearchEngine(string $searchEngine): SearchEngine
    {
        switch($searchEngine) {
            case self::SEARCH_ENGINE_GOOGLE:
                return new GoogleSearch();
            default:
                return new GoogleSearch();
        }
    }
}
