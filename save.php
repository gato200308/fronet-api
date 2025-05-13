<?php
$apiUrl = "https://carsmoviesinventoryproject-production.up.railway.app/api/v1/carsmovies";

$id = $_POST['id'] ?? null;
$data = [
    'carMovieName' => $_POST['carMovieName'],
    'carMovieYear' => $_POST['carMovieYear'],
    'duration' => (int)$_POST['duration']
];

$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n",
        'method'  => $id ? 'PUT' : 'POST',
        'content' => json_encode($data),
    ]
];

$context  = stream_context_create($options);
$url = $id ? "$apiUrl/$id" : $apiUrl;

file_get_contents($url, false, $context);
header("Location: index.php");
exit;
