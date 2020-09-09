<?php
namespace SearchApp\unit\Controller;

use PHPUnit\Framework\TestCase;
use SearchApp\Client\SearchClient;
use GuzzleHttp\Psr7\Response;
use SearchApp\Controller\SearchController;

class SearchControllerTest extends TestCase
{
    public function testGetReturnSuccess(): void
    {
        $result = [1,2,3,4];
        $expected = new Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode($result),
            '1.1'
        );

        $searchEngine = 'testEngine';
        $request = [
            'keyword' => 'testkeyword',
            'url' => 'testurl'
        ];
        $searchClientMock = $this->createMock(SearchClient::class);
        $searchClientMock->expects($this->once())
            ->method('search')
            ->with($searchEngine, $request)
            ->willReturn($result);

        $controller =  new SearchController($searchClientMock);
        $actual = $controller->get($searchEngine, $request);

        $this->assertEquals(
            $expected->getBody()->getContents(),
            $actual->getBody()->getContents()
        );

        $this->assertEquals(
            $expected->getStatusCode(),
            $actual->getStatusCode()
        );
    }
}