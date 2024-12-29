<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['seller_email'])) {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Seller | Add Pickup Order</title>

  <?php include("inc/links.php") ?>

  <style>
    .stepwizard-step p {
      margin-top: 10px;
    }

    .stepwizard-row {
      display: table-row;
    }

    .stepwizard {
      display: table;
      width: 100%;
      position: relative;
    }

    .stepwizard-step button[disabled] {
      opacity: 1 !important;
      filter: alpha(opacity=100) !important;
    }

    .stepwizard-row:before {
      top: 14px;
      bottom: 0;
      position: absolute;
      content: " ";
      width: 100%;
      height: 1px;
      background-color: #ccc;
    }

    .stepwizard-step {
      display: table-cell;
      text-align: center;
      position: relative;
    }

    .btn-circle {
      width: 30px;
      height: 30px;
      text-align: center;
      padding: 6px 0;
      font-size: 12px;
      line-height: 1.428571429;
      border-radius: 15px;
    }

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

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include("inc/topbar.php") ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include("inc/sidebar.php") ?>
    <?php include("../config.php") ?>

    <div id="loader">
      <svg viewBox="25 25 50 50">
        <circle r="20" cy="50" cx="50"></circle>
      </svg>
    </div>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add Pickup Order</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Add Pickup Order</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add new order here</h3>
                </div>
                <div class="container p-5">
                  <form id="parcelForm">
                    <input type="hidden" name="service_type" id="service_type" value="">
                    <input type="hidden" name="service_title" id="service_title" value="">
                    <input type="hidden" name="seller_id" id="seller_id" value="<?php echo $_SESSION['booking_id'] ?>">

                    <div class="form-group">
                      <label class="control-label">Pickup Pincode</label>
                      <input maxlength="6" type="text" required="required" name="deliveryPincode" id="deliveryPincode" class="form-control" placeholder="Enter Pickup Pincode" />
                      <span id="deliveryPincodeMessage"></span>
                    </div>

                    <div id="serviceSection" style="display: none;">
                      <div class="form-group">
                        <label><strong>Choose Delivery Service</strong></label> <br>
                        <span id="serviceMessage" style="color: red;"></span>
                        <div class="delivery">
                          <div class="radio-group" style="display: flex; flex-direction: row; gap: 10px;">
                            <div class="radio-item">
                              <input type="radio" id="optionSuperExpress" name="options" value="Super Express" onclick="showAdditionalOptions('superExpress')">&nbsp;
                              <label for="optionSuperExpress">Super Express</label>
                            </div>
                            <div class="radio-item">
                              <input type="radio" id="optionExpress" name="options" value="Express" onclick="showAdditionalOptions('express')">&nbsp;
                              <label for="optionExpress">Express</label>
                            </div>
                            <div class="radio-item">
                              <input type="radio" id="optionStandard" name="options" value="Standard" onclick="showAdditionalOptions('standard')">&nbsp;
                              <label for="optionStandard">Standard</label>
                            </div>
                          </div>
                        </div>
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
                        $sql1 = "SELECT * FROM services WHERE service_type = 'Standard' && status = 1";
                        $res1 = mysqli_query($conn, $sql1);
                        while ($row = mysqli_fetch_assoc($res1)) {
                        ?>
                          <div class="radio-item">
                            <button type="button" class="standard-btn" data-service_type="<?php echo $row['service_type'] ?>" data-title="<?php echo $row['title'] ?>" data-price="<?php echo $row['price'] ?>" onclick="get_price(this)"><?php echo $row['title'] ?></button>
                          </div>
                        <?php } ?>
                      </div>

                      <!-- Address input fields for Super Express -->
                      <div id="addressSection" style="display: none;">
                        <div class="form-group">
                          <label for="address1"><strong>Pick-up Address</strong></label><br>
                          <input type="text" id="address1" class="form-control" placeholder="Enter pick-up address">
                        </div>
                        <div class="form-group">
                          <label for="address2"><strong>Delivery Address</strong></label><br>
                          <input type="text" id="address2" class="form-control" placeholder="Enter delivery address">
                        </div>
                        <button type="button" onclick="calculateDistance()" style="padding: 10px 20px; border-radius: 10px; background-color: #007BFF; color: white; border: none; cursor: pointer; font-size: 16px; transition: background-color 0.3s;">Calculate Distance</button>
                        <div id="distance"></div>
                      </div>

                      <div class="form-group">
                        <label for="estimatePrice"><strong>Estimate Price</strong></label><br>
                        <input type="text" class="form-control" id="estimatePrice" placeholder="₹ 0" readonly>
                      </div>
                    </div>

                    <div id="senderSection" style="display: none;">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-12" style="margin-left: 10px;">
                            <h2 style="text-align:left">Sender Details</h2>
                            <div class="row">
                              <label for="name">Sender Name</label>
                              <input type="text" id="name" name="sender_name" class="form-control mb-3" placeholder="Enter Sender Name" required>
                              <label for="number">Sender Contact Number</label>
                              <input type="text" id="number" name="sender_number" pattern="[6789][0-9]{9}" class="form-control mb-3" placeholder="Enter Sender Contact Number" required>
                              <label for="email">Sender Email</label>
                              <input type="email" id="email" name="sender_email" class="form-control mb-3" placeholder="Enter Sender Email" required>
                              <label for="address">Sender Full Address</label>
                              <input type="text" id="address" name="sender_address" class="form-control mb-3" placeholder="Enter Sender Address" required>
                              <label for="senderPincode">Sender Pincode</label>
                              <input type="text" id="senderPincode" name="senderPincode" class="form-control mb-3" placeholder="Enter Sender Pincode" required readonly>
                            </div>
                          </div>
                        </div>

                        <!-- Payment options and total cost -->
                        <div class="row">
                          <div class="col-12 col-lg-8 d-flex ">
                            <div>
                              <input class="m-1 me-1" type="radio" id="cod" name="payment_methods" value="cod" onchange="updatePrice()" required>
                            </div>
                            <div>
                              <label for="cod">Cash On Delivery <em class="text-success text-center justify-content-center " style="font-size: 12px;">(COD charges ₹ 30 or 2 % which ever is higher)</em></label>
                            </div>
                          </div>

                          <div class="col-12 col-lg-4 d-flex">
                            <div>
                              <input class="m-1" type="radio" id="online" name="payment_methods" value="online" onchange="updatePrice()" required>
                            </div>
                            <div>
                              <label for="online">Prepaid Order</label>
                            </div>
                          </div>
                        </div>

                        <div class="row ">
                          <div class="col-12 d-flex">
                            <div>
                              <input class="m-1" type="checkbox" name="insurance" id="insurance" value="" onchange="updatePrice()">
                            </div>
                            <div>
                              <label for="insurance">Do you want to insure your order? <em class="text-success" style="font-size: 12px;">(Insurance charges 50 or 1 % which ever is higher)</em></label>
                            </div>
                          </div>
                        </div>

                        <div class="row w-100">
                          <div class="col-12">
                            <!-- Total cost -->
                            <input type="hidden" id="amount" name="price" value="0">
                            <h4>Total Cost - ₹ <span id="amounts">0</span></h4>
                          </div>
                        </div>
                        <!-- Submit button -->
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit" id="bookParcelBtn3">Submit Order</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <?php include("inc/footer.php") ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx_5V0k3AP2ZxGMNZ7TSy0LnhwChWuDoE&libraries=places"></script>

  <script>
    $(document).ready(function() {
      $('#deliveryPincode').on('change', function() {
        var pincode = $(this).val();
        var messageElement = $(this).next('span');

        // Clear previous message
        messageElement.text('');

        // Perform AJAX request to check pincode
        $.ajax({
          url: '../../check_pincode.php',
          method: 'POST',
          data: {
            pincode: pincode
          },
          success: function(response) {
            var res = JSON.parse(response)
            console.log(res)
            if (res.status == 'not_found') {
              messageElement.text('This Pincode is not available.');
              messageElement.css('color', 'red');
            } else {
              messageElement.text('This Pincode is available.'); // Clear message if pincode is found
              messageElement.css('color', 'green');
              $('#serviceSection').show();
            }
          },
          error: function() {
            messageElement.text('An error occurred while checking the pincode.');
          }
        });
      });

      // Update the sender pincode based on the delivery pincode
      $('#deliveryPincode').on('input', function() {
        var deliveryPincode = $(this).val();
        $('#senderPincode').val(deliveryPincode);
      });

      $('#estimatePrice').on('change', function() {
        var estimatePrice = $(this).val();
        if (estimatePrice > 0) {
          $('#senderSection').show();
        }
      });

      // Initialize the total cost with the estimated price
      updateTotalCost();
    });

    //----------------------------------------------------------------------------------//
    //                               calculate Price Based on distance
    //----------------------------------------------------------------------------------//
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

      // Update the total cost
      updateTotalCost();
    }

    //----------------------------------------------------------------------------------//
    //                               Show Additional Options
    //----------------------------------------------------------------------------------//
    function showAdditionalOptions(option) {
      // Reset the price when switching between services
      document.getElementById('estimatePrice').value = "₹ 0";

      // Hide all weight/distance options by default
      document.getElementById('expressWeightOptions').style.display = 'none';
      document.getElementById('standardWeightOptions').style.display = 'none';
      document.getElementById('addressSection').style.display = 'none';

      // Show distance options for Super Express and weight options for others
      if (option === 'superExpress') {
        document.getElementById('addressSection').style.display = 'block';
      } else if (option === 'express') {
        document.getElementById('expressWeightOptions').style.display = 'flex';
      } else if (option === 'standard') {
        document.getElementById('standardWeightOptions').style.display = 'flex';
      }
    }

    //----------------------------------------------------------------------------------//
    //                               Get price
    //----------------------------------------------------------------------------------//
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

      // Set the service type and title in the hidden input fields
      $('#service_type').val(serviceName);
      $('#service_title').val(title);

      if (price > 0) {
        $('#senderSection').show();
      }

      // Update the total cost
      updateTotalCost();
    }

    //----------------------------------------------------------------------------------//
    //                               Google maps Autocomplete                            //----------------------------------------------------------------------------------//

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

    //----------------------------------------------------------------------------------//
    //                               Google maps Distance Calculation                           //----------------------------------------------------------------------------------//

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

              // Set the service type and title in the hidden input fields
              $('#service_type').val('Super Express');
              $('#service_title').val(approxDis + ' km');

              if (price > 0) {
                $('#senderSection').show();
              }

              // Update the total cost
              updateTotalCost();
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

    //-------------------------------- Update Price -----------------------------------//

    function updatePrice() {
      var paymentMethod = document.querySelector('input[name="payment_methods"]:checked');
      var insuranceChecked = document.getElementById('insurance').checked;
      var price = parseFloat(localStorage.getItem('price'));
      var totalPrice = price;

      if (paymentMethod && paymentMethod.value === 'cod') {
        var codCharges = Math.max(30, price * 0.02);
        totalPrice += codCharges;
      }

      if (insuranceChecked) {
        var insuranceCharges = Math.max(50, price * 0.01);
        totalPrice += insuranceCharges;
      }

      document.getElementById('amount').value = totalPrice;
      document.getElementById('amounts').textContent = totalPrice;
    }

    //-------------------------------- Update Total Cost -----------------------------------//

    function updateTotalCost() {
      var price = parseFloat(localStorage.getItem('price')) || 0;
      var totalPrice = price;

      var paymentMethod = document.querySelector('input[name="payment_methods"]:checked');
      if (paymentMethod && paymentMethod.value === 'cod') {
        var codCharges = Math.max(30, price * 0.02);
        totalPrice += codCharges;
      }

      var insuranceChecked = document.getElementById('insurance').checked;
      if (insuranceChecked) {
        var insuranceCharges = Math.max(50, price * 0.01);
        totalPrice += insuranceCharges;
      }

      document.getElementById('amount').value = totalPrice;
      document.getElementById('amounts').textContent = totalPrice;
    }

    $('#parcelForm').on('submit', function(event) {
      event.preventDefault();

      var formData = $(this).serialize();

      $.ajax({
        url: 'save_order2.php',
        method: 'POST',
        data: formData,
        success: function(response) {
          console.log(response)
          alert('Order saved successfully!');
          // window.location.reload();
        },
        error: function() {
          alert('Error saving the order. Please try again.');
        }
      });
    });
  </script>

  <!-- ./wrapper -->

</body>

</html>