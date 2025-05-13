<?php
$id = $_GET['id'] ?? null;
$apiUrl = "https://carsmoviesinventoryproject-production.up.railway.app/api/v1/carsmovies";

if ($id) {
    $options = [
        'http' => [
            'method' => 'DELETE',
        ]
    ];
    $context = stream_context_create($options);
    file_get_contents("$apiUrl/$id", false, $context);
}

header("Location: index.php");
exit;
