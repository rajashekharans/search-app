<?php
$httpClient = new GuzzleHttp\Client();
$searchClient =  new \SearchApp\Client\SearchClient($httpClient);
$searchController = new \SearchApp\Controller\SearchController($searchClient);

$options = [
    'keyword' => htmlentities($_REQUEST['keyword']),
    'url' => htmlentities($_REQUEST['url']),
];

$searchEngine = 'google';

try {
    $result = $searchController->get($searchEngine, $options);
    $resultArray = json_decode($result->getBody(), true);
    $resultToDisplay = count($resultArray) > 0 ? implode(', ', $resultArray) : 0;
    ?>
    <h3 style="text-align: center;">Results: <?=$resultToDisplay?></h3>
    <?php
} catch (\SearchApp\Exception\HttpResponseException $exception) {
    ?>
    <h3 style="text-align: center;">Bad Request.</h3>
    <?php
}
