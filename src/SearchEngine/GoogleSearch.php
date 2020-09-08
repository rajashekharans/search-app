<?php
namespace SearchApp\SearchEngine;

use SearchApp\Exception\HttpResponseException;
use GuzzleHttp\Exception\RequestException;

class GoogleSearch extends SearchEngine
{
    public function search(array $options)
    {
        $result = [];

        $startIndex = 1;
        do {
            $endpoint = sprintf('%s?key=%s&cx=%s&q=%s&start=%s',
                $_ENV['GOOGLE_URL'],
                $_ENV['GOOGLE_API_KEY'],
                $_ENV['GOOGLE_SEARCH_ENGINE_ID'],
                $options['keyword'],
                $startIndex);

            try {
                $response = $this->getHttpClient()->request('GET', $endpoint);
                if($response->getStatusCode() !== 200) {
                    throw new HttpResponseException('Bad Request');
                }
                $queryResult = json_decode($response->getBody());
                $startIndex = isset($queryResult->queries->nextPage) ?
                    $queryResult->queries->nextPage[0]->startIndex : -1;

                $result = array_merge($result, $queryResult->items);
            } catch (RequestException $e) {
                throw new HttpResponseException ($e->getMessage());
            }
        } while ($startIndex !== -1);

        return $this->processSearchResult($options['url'], $result);
    }

    private function processSearchResult(string $url, $result): array
    {
        $column = array_column($result, 'link');

        $searchResult = [];
        foreach ($column as $key => $value) {
            if (str_contains($value, $url)) {
                $searchResult[] = $key + 1;
            }
        }

        return $searchResult;
    }
}