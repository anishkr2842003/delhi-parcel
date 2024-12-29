<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distance Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        input,
        button {
            display: block;
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        #distance {
            margin-top: 20px;
            font-size: 1.2em;
        }

        .suggestions {
            border: 1px solid #ccc;
            margin-top: 5px;
            max-height: 150px;
            overflow-y: auto;
            background: #fff;
        }

        .suggestions div {
            padding: 10px;
            cursor: pointer;
        }

        .suggestions div:hover {
            background: #f0f0f0;
        }
    </style>
</head>

<body>
    <h1>Distance Calculator</h1>
    <input type="text" id="address1" placeholder="Enter first address">
    <div id="suggestions1" class="suggestions"></div>
    <input type="text" id="address2" placeholder="Enter second address">
    <div id="suggestions2" class="suggestions"></div>
    <button onclick="calculateDistance()">Calculate Distance</button>
    <div id="distance"></div>

    <!-- <script src="script.js"></script> -->
    <script>
        // script.js
        function haversineDistance(lat1, lon1, lat2, lon2) {
            const earthRadius = 6371;
            const toRadians = (degrees) => degrees * (Math.PI / 180);
            const deltaLat = toRadians(lat2 - lat1);
            const deltaLon = toRadians(lon2 - lon1);
            const a = Math.sin(deltaLat / 2) * Math.sin(deltaLat / 2) +
                Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) *
                Math.sin(deltaLon / 2) * Math.sin(deltaLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return earthRadius * c;
        }

        document.addEventListener('DOMContentLoaded', function() {
            function initializeAutocomplete(inputField, suggestionsDiv) {
                inputField.addEventListener('input', function() {
                    const query = inputField.value;
                    if (query.length < 3) {
                        suggestionsDiv.innerHTML = '';
                        return;
                    }

                    fetch(`https://api.geoapify.com/v1/geocode/autocomplete?text=${query}&filter=countrycode:in&format=json&apiKey=9da23fcd793b4acfba8f7f0100e20eea`)
                        .then(response => response.json())
                        .then(data => {
                            // console.log('API Response:', data); // Log the entire API response
                            suggestionsDiv.innerHTML = '';
                            if (data.results && Array.isArray(data.results)) {
                                data.results.forEach(item => {
                                    console.log('item :', item)
                                    const suggestion = document.createElement('div');
                                    suggestion.textContent = `${item.formatted} : ${item.plus_code_short}`;
                                    suggestion.addEventListener('click', function() {
                                        inputField.value = item.formatted;
                                        inputField.dataset.lat = item.lat;
                                        inputField.dataset.lon = item.lon;
                                        suggestionsDiv.innerHTML = '';
                                    });
                                    suggestionsDiv.appendChild(suggestion);
                                });
                            } else {
                                console.error('No suggestions found or invalid response format.');
                            }
                        })
                        .catch(error => console.error('Error fetching suggestions:', error));
                });
            }

            initializeAutocomplete(document.getElementById('address1'), document.getElementById('suggestions1'));
            initializeAutocomplete(document.getElementById('address2'), document.getElementById('suggestions2'));
        });

        // function calculateDistance() {
        //     const address1 = document.getElementById('address1');
        //     const address2 = document.getElementById('address2');

        //     const lat1 = parseFloat(address1.dataset.lat);
        //     const lon1 = parseFloat(address1.dataset.lon);
        //     const lat2 = parseFloat(address2.dataset.lat);
        //     const lon2 = parseFloat(address2.dataset.lon);

        //     if (lat1 && lon1 && lat2 && lon2) {
        //         const distance = haversineDistance(lat1, lon1, lat2, lon2);
        //         document.getElementById('distance').textContent = 'Distance: ' + distance.toFixed(2) + ' km';
        //     } else {
        //         document.getElementById('distance').textContent = 'Please select valid addresses from the suggestions.';
        //     }
        // }
        function calculateDistance() {
            const address1 = document.getElementById('address1');
            const address2 = document.getElementById('address2');
            const lat1 = address1.dataset.lat;
            const lon1 = address1.dataset.lon;
            const lat2 = address2.dataset.lat;
            const lon2 = address2.dataset.lon;

            if (lat1 && lon1 && lat2 && lon2) {
                // const waypoints = `${lon1},${lat1}|${lon2},${lat2}`;
                const waypoints = `${lat1},${lon1}|${lat2},${lon2}`;
                // const mode = 'motorcycle';
                const mode = 'drive';
                const apiKey = '9da23fcd793b4acfba8f7f0100e20eea';

                fetch(`get_distance.php?waypoints=${waypoints}&mode=${mode}&apiKey=${apiKey}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.features && data.features.length > 0) {
                            const distance = data.features[0].properties.distance;
                            document.getElementById('distance').textContent = 'Distance: ' + (distance / 1000).toFixed(2) + ' km';
                        } else {
                            document.getElementById('distance').textContent = 'No route found.';
                        }
                    })
                    .catch(error => {
                        document.getElementById('distance').textContent = 'Error calculating distance. Please try again.';
                        console.error('Error calculating distance:', error);
                    });
            } else {
                document.getElementById('distance').textContent = 'Please select valid addresses from the suggestions.';
            }
        }
    </script>
</body>

</html>