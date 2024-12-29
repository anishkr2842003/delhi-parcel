<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delhi Parcel</title>
    <link rel="stylesheet" href="/assets/CSS/style.css">
    <style>
        .distance-btn,
        .express-btn,
        .standard-btn {
            padding: 10px 20px;
            background-color: #000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .distance-btn:hover,
        .express-btn:hover,
        .standard-btn:hover {
            background-color: green;
        }

        /* Active button state */
        .distance-btn#active,
        .express-btn#active,
        .standard-btn#active {
            background-color: #ff5d01;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);
        }

        button:disabled,
        button[disabled] {
            cursor: not-allowed;
        }

        /* Normal button state */
        .distance-btn {
            background-color: #000;
            color: white;
        }

        .additional-options {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .item-weight-options {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .item-weight-options .radio-item {
            display: flex;
            align-items: center;
        }

        .item-weight-options input[type="radio"] {
            margin-right: 5px;
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

        #loader {
            height: 100%;
            width: 100%;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
            display: none;
        }

        /* universe.io code for loader */
        svg {
            width: 3.25em;
            transform-origin: center;
            animation: rotate4 2s linear infinite;
        }

        circle {
            fill: none;
            stroke: hsl(214, 97%, 59%);
            stroke-width: 5;
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
            stroke-linecap: round;
            animation: dash4 1.5s ease-in-out infinite;
        }

        @keyframes rotate4 {
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes dash4 {
            0% {
                stroke-dasharray: 1, 200;
                stroke-dashoffset: 0;
            }

            50% {
                stroke-dasharray: 90, 200;
                stroke-dashoffset: -35px;
            }

            100% {
                stroke-dashoffset: -125px;
            }
        }
    </style>
</head>

<body>
    <?php include_once("admin/config.php"); ?>
    <div class="hero" style="background-image: url('assets/images/background.png')">
        <div id="loader">
            <svg viewBox="25 25 50 50">
                <circle r="20" cy="50" cx="50"></circle>
            </svg>
        </div>
        <div class="hero-content">
            <div class="container-form">
                <h1>Book your parcel</h1>
                <form>
                    <div class="form-group">
                        <label for="pickupPincode"><strong>Pick-up Pincode</strong></label><br>
                        <input type="text" class="form-control" id="pickupPincode" placeholder="Pick-up Pincode" required>
                        <span id="pickupPincodeMessage" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label for="deliveryPincode"><strong>Delivery Pincode</strong></label><br>
                        <input type="text" class="form-control" id="deliveryPincode" placeholder="Delivery Pincode" required>
                        <span id="deliveryPincodeMessage" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label><strong>Choose Delivery Service</strong></label> <br>
                        <span id="serviceMessage" style="color: red;"></span>
                        <div class="delivery">
                            <div class="radio-group">
                                <div class="radio-item">
                                    <input type="radio" id="optionSuperExpress" name="options" value="Super Express"
                                        onclick="showAdditionalOptions('superExpress')">&nbsp;
                                    <label for="optionSuperExpress">Super Express <i title="Guaranteed Delivery Within 4 Hours"
                                            style="background: blue; padding: 6px; color: white; font-weight: bold; border-radius: 50%;">i</i></label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="optionExpress" name="options" value="Express"
                                        onclick="showAdditionalOptions('express')">&nbsp;
                                    <label for="optionExpress">Express <i title="Guaranteed Delivery Within 4 Hours"
                                            style="background: blue; padding: 6px; color: white; font-weight: bold; border-radius: 50%;">i</i></label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="optionStandard" name="options" value="Standard"
                                        onclick="showAdditionalOptions('standard')">&nbsp;
                                    <label for="optionStandard">Standard <i title="Guaranteed Delivery Within 4 Hours"
                                            style="background: blue; padding: 6px; color: white; font-weight: bold; border-radius: 50%;">i</i></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New section to handle distance options for Super Express and weight options for others -->
                    <div class="form-group" id="weightSection" style="display: none;">
                        <!-- <h8>Choose Weight/Distance</h8> -->

                        <!-- Super Express distance options (in kilometers) -->
                        <div id="superExpressDistanceOptions" class="item-weight-options" style="display: none;">
                            <!-- <?php
                                    $sql1 = "SELECT * FROM services WHERE service_type = 'Super-Express' && status = 1";
                                    $res1 = mysqli_query($conn, $sql1);
                                    while ($row = mysqli_fetch_assoc($res1)) {
                                    ?>
                                <div class="radio-item">
                                    <button type="button" class="distance-btn" data-service_type="<?php echo $row['service_type'] ?>" data-title="<?php echo $row['title'] ?>" data-price="<?php echo $row['price'] ?>" onclick="get_price(this)"><?php echo $row['title'] ?></button>
                                </div>
                            <?php } ?> -->
                        </div>

                        <!-- Express weight options (in kg) -->
                        <div id="expressWeightOptions" class="item-weight-options" style="display: none;">
                            <?php
                            $sql1 = "SELECT * FROM services WHERE service_type = 'Express' && status = 1";
                            $res1 = mysqli_query($conn, $sql1);
                            while ($row = mysqli_fetch_assoc($res1)) {
                            ?>
                                <div class="radio-item">
                                    <button type="button" class="express-btn" data-service_type="<?php echo $row['service_type'] ?>" data-title="<?php echo $row['title'] ?>" data-price="<?php echo $row['price'] ?>" onclick="get_price(this)"><?php echo $row['title'] ?></button>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- Standard weight options (in kg) -->
                        <div id="standardWeightOptions" class="item-weight-options" style="display: none;">
                            <?php
                            $sql1 = "SELECT * FROM services WHERE service_type = 'Standred' && status = 1";
                            $res1 = mysqli_query($conn, $sql1);
                            while ($row = mysqli_fetch_assoc($res1)) {
                            ?>
                                <div class="radio-item">
                                    <button type="button" class="standard-btn" data-service_type="<?php echo $row['service_type'] ?>" data-title="<?php echo $row['title'] ?>" data-price="<?php echo $row['price'] ?>" onclick="get_price(this)"><?php echo $row['title'] ?></button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Address input fields for Super Express -->
                    <div id="addressSection" style="display: none;">
                        <div class="form-group">
                            <label for="address1"><strong>Pick-up Address</strong></label><br>
                            <input type="text" id="address1" class="form-control" placeholder="Enter pick-up address">
                            <!-- <div id="suggestions1" class="suggestions"></div> -->
                        </div>
                        <div class="form-group">
                            <label for="address2"><strong>Delivery Address</strong></label><br>
                            <input type="text" id="address2" class="form-control" placeholder="Enter delivery address">
                            <!-- <div id="suggestions2" class="suggestions"></div> -->
                        </div>
                        <!-- <button type="button" onclick="calculateDistance()" style="padding: 10px; border-radius: 10px; ">Calculate Distance</button> -->
                        <button type="button" onclick="calculateDistance()" style="padding: 10px 20px; border-radius: 10px; background-color: #007BFF; color: white; border: none; cursor: pointer; font-size: 16px; transition: background-color 0.3s;">Calculate Distance</button>
                        <div id="distance"></div>
                    </div>

                    <div class="form-group">
                        <label for="estimatePrice"><strong>Estimate Price</strong></label><br>
                        <input type="text" class="form-control" id="estimatePrice" placeholder="₹ 0" readonly>
                    </div>

                    <a>
                        <button data-label="Register" class="rainbow-hover" id="bookParcelBtn">
                            <span class="sp">Book Parcel</span>
                        </button>
                    </a>
                </form>
            </div>
        </div>
    </div>

    <!-- script for pricing when choose services -->
    <script>
        function calculatePrice(distance) {
            let price = 0;
            if (distance <= 3) {
                price = 50;
            } else {
                price = 50 + (distance - 3) * 5;
            }
            document.getElementById('estimatePrice').value = "₹ " + price;
            localStorage.setItem('serviceName', 'Super-Express');
            localStorage.setItem('title', distance + ' km');
            localStorage.setItem('price', price);
        }

        function showAdditionalOptions(option) {
            // Reset the price when switching between services
            document.getElementById('estimatePrice').value = "₹ 0";

            // Hide all weight/distance options by default
            document.getElementById('superExpressDistanceOptions').style.display = 'none';
            document.getElementById('expressWeightOptions').style.display = 'none';
            document.getElementById('standardWeightOptions').style.display = 'none';
            document.getElementById('addressSection').style.display = 'none';

            // Show distance options for Super Express and weight options for others
            if (option === 'superExpress') {
                document.getElementById('superExpressDistanceOptions').style.display = 'flex';
                document.getElementById('addressSection').style.display = 'block';
            } else if (option === 'express') {
                document.getElementById('expressWeightOptions').style.display = 'flex';
            } else if (option === 'standard') {
                document.getElementById('standardWeightOptions').style.display = 'flex';
            }

            // Show the weight/distance section
            document.getElementById('weightSection').style.display = 'block';
        }

        function get_price(button) {
            // Get data attributes from the button
            var serviceName = button.getAttribute('data-service_type');
            var title = button.getAttribute('data-title');
            var price = button.getAttribute('data-price');

            // Update the estimated price input field
            $('#estimatePrice').val('₹ ' + price);

            // Save data to localStorage
            localStorage.setItem('serviceName', serviceName);
            localStorage.setItem('title', title);
            localStorage.setItem('price', price);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx_5V0k3AP2ZxGMNZ7TSy0LnhwChWuDoE&libraries=places"></script>

    <script>
        $(document).ready(function() {
            // fetching pincode found or not
            $('#pickupPincode, #deliveryPincode').on('change', function() {
                var pincode = $(this).val();
                var messageElement = $(this).next('span');
                var bookParcelBtn = $('#bookParcelBtn');

                // Clear previous message
                messageElement.text('');

                // Perform AJAX request to check pincode
                $.ajax({
                    url: 'check_pincode.php',
                    method: 'POST',
                    data: {
                        pincode: pincode
                    },
                    success: function(response) {
                        var res = JSON.parse(response)
                        if (res.status == 'not_found') {
                            messageElement.text('This Pincode is not available.');
                            messageElement.css('color', 'red');
                            bookParcelBtn.prop('disabled', true);
                        } else {
                            messageElement.text('This Pincode is available.'); // Clear message if pincode is found
                            messageElement.css('color', 'green');
                            bookParcelBtn.prop('disabled', false); // Enable the button
                        }
                    },
                    error: function() {
                        messageElement.text('An error occurred while checking the pincode.');
                        bookParcelBtn.prop('disabled', true);
                    }
                });
            });

            // go to next page when click on book parcel
            $('#bookParcelBtn').on('click', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var pickupPincode = $('#pickupPincode').val();
                var deliveryPincode = $('#deliveryPincode').val();
                var service = $('input[name="options"]:checked').val();
                var messageElement = $('#pickupPincodeMessage');
                var messageElement2 = $('#deliveryPincodeMessage');
                var serviceMessage = $('#serviceMessage');
                var bookParcelBtn = $('#bookParcelBtn');

                // Clear previous messages
                messageElement.text('');

                // Validate pincodes
                if (!pickupPincode) {
                    messageElement.text('Pincode is required');
                    bookParcelBtn.prop('disabled', true);
                    return;
                }
                if (!deliveryPincode) {
                    messageElement2.text('Pincode is required');
                    bookParcelBtn.prop('disabled', true);
                    return;
                }

                // Validate service selection
                if (!service) {
                    serviceMessage.text('Please choose a delivery service');
                    // bookParcelBtn.prop('disabled', true);
                    return;
                }

                // Save data to localStorage
                localStorage.setItem('pickupPincode', pickupPincode);
                localStorage.setItem('deliveryPincode', deliveryPincode);
                localStorage.setItem('service', service);

                // Redirect to bookparcelform.php
                window.location.href = 'bookparcelform.php';
            });
        });

        // Initialize Google Maps Autocomplete
        function initializeAutocomplete() {
            const address1 = document.getElementById('address1');
            const address2 = document.getElementById('address2');

            const autocomplete1 = new google.maps.places.Autocomplete(address1);
            const autocomplete2 = new google.maps.places.Autocomplete(address2);

            autocomplete1.addListener('place_changed', function() {
                const place = autocomplete1.getPlace();
                if (place.geometry) {
                    address1.dataset.lat = place.geometry.location.lat();
                    address1.dataset.lon = place.geometry.location.lng();
                }
            });

            autocomplete2.addListener('place_changed', function() {
                const place = autocomplete2.getPlace();
                if (place.geometry) {
                    address2.dataset.lat = place.geometry.location.lat();
                    address2.dataset.lon = place.geometry.location.lng();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeAutocomplete();
        });

        function calculateDistance() {
            const address1 = document.getElementById('address1');
            const address2 = document.getElementById('address2');
            const lat1 = address1.dataset.lat;
            const lon1 = address1.dataset.lon;
            const lat2 = address2.dataset.lat;
            const lon2 = address2.dataset.lon;

            if (lat1 && lon1 && lat2 && lon2) {
                const origin = `${lat1},${lon1}`;
                const destination = `${lat2},${lon2}`;
                const proxyUrl = `proxy.php?origin=${origin}&destination=${destination}`;

                document.getElementById('loader').style.display = 'flex';

                fetch(proxyUrl)
                    .then(response => response.json())
                    .then(data => {
                        var distance = data.routes[0].legs[0].distance.text;
                        console.log(data.routes[0])
                        if (data) {
                            document.getElementById('distance').textContent = 'Distance: ' + distance;

                            const distanceNumber = parseFloat(distance.replace(' km', '').replace(',', '.'));
                            const approxDis = Math.ceil(distanceNumber)
                            document.getElementById('distance').textContent = 'Distance Approx: ' + approxDis + ' km';
                            let price = 0;
                            if (approxDis <= 3) {
                                price = 50;
                            } else {
                                price = 50 + (approxDis - 3) * 5;
                            }

                            // Update the estimated price input field
                            document.getElementById('estimatePrice').value = "₹ " + price;
                            localStorage.setItem('title', "Super Express");
                            localStorage.setItem('price', price);
                        } else {
                            document.getElementById('distance').textContent = 'No route found.';
                        }
                        document.getElementById('loader').style.display = 'none';
                    })
                    .catch(error => {
                        document.getElementById('distance').textContent = 'Error calculating distance. Please try again.';
                        console.error('Error calculating distance:', error);
                        document.getElementById('loader').style.display = 'none';
                    });
            } else {
                document.getElementById('distance').textContent = 'Please select valid addresses from the suggestions.';
            }
        }
    </script>



</body>

</html>