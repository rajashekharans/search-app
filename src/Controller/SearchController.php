<?php
namespace SearchApp\Controller;

use SearchApp\Client\SearchClient;
use GuzzleHttp\Psr7\Response;

class SearchController 
{
    private $searchClient;

    public function __construct(SearchClient $searchClient)
    {
        $this->searchClient = $searchClient;
    }

    public function get(string $searchEngine, array $request): Response
    {
        $result = $this->searchClient->search($searchEngine, $request);

        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode($result),
            '1.1'
        );
        return $response;
    }
}
