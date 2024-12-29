<?php
if (isset($_GET['waypoints']) && isset($_GET['mode']) && isset($_GET['apiKey'])) {
    $waypoints = $_GET['waypoints'];
    $mode = $_GET['mode'];
    $apiKey = $_GET['apiKey'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.geoapify.com/v1/routing?waypoints=$waypoints&mode=$mode&apiKey=$apiKey",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo json_encode(['error' => 'Curl error: ' . curl_error($curl)]);
    } else {
        echo $response;
    }

    curl_close($curl);
} else {
    echo json_encode(['error' => 'Missing parameters']);
}
