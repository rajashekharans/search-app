<?php
/**
 * Created by PhpStorm.
 * User: rushinaidu
 * Date: 7/9/20
 * Time: 3:37 AM
 */

namespace SearchApp\Client;

use GuzzleHttp\Client;
use SearchApp\SearchEngine\SearchEngine;
use SearchApp\SearchEngine\GoogleSearch;
use SearchApp\SearchEngine\MicrosoftSearch;

class SearchClient
{
    private const SEARCH_ENGINE_GOOGLE = 'google';
    private const SEARCH_ENGINE_MICROSOFT = 'microsoft';

    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function search(string $searchEngine, array $options)
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
            case self::SEARCH_ENGINE_MICROSOFT:
                return new MicrosoftSearch();
            default:
                return new GoogleSearch();
        }
    }
}
