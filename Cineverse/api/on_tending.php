<?php
require_once('../vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$keren = $client->request('GET', 'https://api.themoviedb.org/3/trending/movie/day?language=en-US', [
    'headers' => [
        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlZmUyZGFjNTJmMGFhYzJmYTA2NDYxYmU3NmE2MDNhZCIsInN1YiI6IjY1ODJlNDllZmJlMzZmNGIyZDdmMDFiNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.hHCODLZTt5CVM4E9Lz7mo9N4VGz1W8NDnQcOwg6Wwaw',
        'accept' => 'application/json',
    ],
]);

// echo $response->getBody();
