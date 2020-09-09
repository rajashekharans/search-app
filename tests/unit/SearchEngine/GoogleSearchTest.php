<?php
/**
 * Created by PhpStorm.
 * User: rushinaidu
 * Date: 8/9/20
 * Time: 5:02 PM
 */

namespace SearchApp\unit\SearchEngine;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\RequestInterface;
use SearchApp\Exception\HttpResponseException;
use SearchApp\SearchEngine\GoogleSearch;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class GoogleSearchTest extends TestCase
{
    public function testSearchReturnSuccess(): void
    {
        $expected = [1, 3, 11];
        $jsonResponse1 = file_get_contents(__DIR__."/Responses/response1.json");
        $jsonResponse2 = file_get_contents(__DIR__."/Responses/response10.json");

        $responseMock = $this->createMock(Response::class);
        $responseMock->expects($this->any())
            ->method('getBody')
            ->withAnyParameters()
            ->willReturnOnConsecutiveCalls(
                $jsonResponse1,
                $jsonResponse2
                );

        $responseMock->expects($this->any())
            ->method('getStatusCode')
            ->withAnyParameters()
            ->willReturnOnConsecutiveCalls(200, 200);

        $httpClientMock = $this->createMock(Client::class);
        $httpClientMock->expects($this->any())
            ->method('request')
            ->withAnyParameters()
            ->willReturn($responseMock);

        $googleSearch = new GoogleSearch();
        $googleSearch->setHttpClient($httpClientMock);
        $actual = $googleSearch->search([
            'keyword' => 'creditorwatch',
            'url' => 'https://creditorwatch.com.au'
        ]);

        $this->assertEquals($expected, $actual);
    }

    public function testSearchThrowExceptionForBadRequest(): void
    {
        $responseMock = $this->createMock(Response::class);

        $responseMock->expects($this->any())
            ->method('getStatusCode')
            ->withAnyParameters()
            ->willReturn(400);

        $httpClientMock = $this->createMock(Client::class);
        $httpClientMock->expects($this->any())
            ->method('request')
            ->withAnyParameters()
            ->willReturn($responseMock);

        $this->expectException(HttpResponseException::class);

        $googleSearch = new GoogleSearch();
        $googleSearch->setHttpClient($httpClientMock);

        $googleSearch->search([
            'keyword' => 'creditorwatch',
            'url' => 'https://creditorwatch.com.au'
        ]);
    }

    public function testSearchThrowExceptionForGuzzleException(): void
    {

        $requestMock = $this->createMock(RequestInterface::class);

        $httpClientMock = $this->createMock(Client::class);
        $httpClientMock->expects($this->any())
            ->method('request')
            ->withAnyParameters()
            ->willThrowException(RequestException::create($requestMock));

        $this->expectException(HttpResponseException::class);

        $googleSearch = new GoogleSearch();
        $googleSearch->setHttpClient($httpClientMock);

        $googleSearch->search([
            'keyword' => 'creditorwatch',
            'url' => 'https://creditorwatch.com.au'
        ]);
    }
}