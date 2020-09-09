<?php
namespace SearchApp\SearchEngine;

use GuzzleHttp\Client;

abstract class SearchEngine
{
    private $httpClient;

    abstract public function search(array $options): array;

    public function setHttpClient(Client $httpClient): SearchEngine
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }
}