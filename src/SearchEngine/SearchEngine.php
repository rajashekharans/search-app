<?php
namespace SearchApp\SearchEngine;

use GuzzleHttp\Client;

abstract class SearchEngine
{
    private $httpClient;

    abstract public function search(array $options);

    public function setHttpClient(Client $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function getHttpClient()
    {
        return $this->httpClient;
    }
}