<?php
namespace SearchApp\unit\Client;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use SearchApp\Client\SearchClient;
use SearchApp\SearchEngine\GoogleSearch;

class SearchClientTest extends TestCase
{
    /**
     * @dataProvider getSearchEngineDataProvider
     */
    public function testGetSearchEngineReturnsGoogleSearch(string $searchEngine, string $class): void
    {
        $httpClient = new Client();

        $searchClient = new SearchClient($httpClient);
        $actual = $searchClient->getSearchEngine($searchEngine);

        $this->assertInstanceOf($class, $actual);
    }

    public function getSearchEngineDataProvider(): array
    {
        return [
            ['google', GoogleSearch::class],
            ['random', GoogleSearch::class]
        ];
    }

}