<?php
// suggestions.php

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $apiKey = 'AIzaSyAx_5V0k3AP2ZxGMNZ7TSy0LnhwChWuDoE';
    $url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input={$query}&key={$apiKey}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    $suggestions = [];

    if (isset($data['predictions'])) {
        foreach ($data['predictions'] as $prediction) {
            $suggestions[] = $prediction['description'];
        }
    }

    echo json_encode($suggestions);
}
