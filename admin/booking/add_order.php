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
  <title>Seller | Add Order</title>

  <?php include("inc/links.php") ?>

  <style>
    /* body {
      margin-top: 40px;
    } */

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
      /* z-order: 0; */

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

    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add Order</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Add Order</li>
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
                  <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                      <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                        <p>Step 1</p>
                      </div>
                      <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p>Step 2</p>
                      </div>
                      <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p>Step 3</p>
                      </div>
                    </div>
                  </div>
                  <form id="parcelForm">
                    <!-- Step 1 -->
                    <div class="row setup-content" id="step-1">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <h3>Choose Pin code</h3>
                          <div class="form-group">
                            <label class="control-label">Pick-up Pincode</label>
                            <input maxlength="6" type="text" required="required" name="pickupPincode" id="pickupPincode" class="form-control" placeholder="Enter Pick-up Pincode" />
                            <span id="pickupPincodeMessage"></span>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Delivery Pincode</label>
                            <input maxlength="6" type="text" required="required" name="deliveryPincode" id="deliveryPincode" class="form-control" placeholder="Enter Delivery Pincode" />
                            <span id="deliveryPincodeMessage"></span>
                          </div>
                          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="bookParcelBtn">Next</button>
                        </div>
                      </div>
                    </div>
                    <!-- Step 2 -->
                    <div class="row setup-content" id="step-2">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <h3>Choose Service</h3>
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
                            <div id="suggestions1" class="suggestions"></div>
                          </div>
                          <div class="form-group">
                            <label for="address2"><strong>Delivery Address</strong></label><br>
                            <input type="text" id="address2" class="form-control" placeholder="Enter delivery address">
                            <div id="suggestions2" class="suggestions"></div>
                          </div>
                          <button type="button" onclick="calculateDistance()" style="padding: 10px 20px; border-radius: 10px; background-color: #007BFF; color: white; border: none; cursor: pointer; font-size: 16px; transition: background-color 0.3s;">Calculate Distance</button>
                          <div id="distance"></div>
                        </div>

                        <div class="form-group">
                          <label for="estimatePrice"><strong>Estimate Price</strong></label><br>
                          <input type="text" class="form-control" id="estimatePrice" placeholder="₹ 0" readonly>
                        </div>

                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" id="bookParcelBtn2">Next</button>
                      </div>
                    </div>

                    <!-- Step 3 -->
                    <?php
                    $sellerId =  $_SESSION['seller_id'];

                    $sql = "SELECT * FROM seller WHERE id = $sellerId";
                    $result = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_assoc($result);
                    // var_dump($row);
                    // echo $row["fullName"];

                    ?>
                    <div class="row setup-content pb-5" id="step-3">
                      <div class="col-md-12">
                        <div class="col-md-12">
                          <!-- <h3>Step 3</h3> -->
                          <div class="container">
                            <h1 style="text-align:center;text-decoration: underline;">Parcel Details</h1>

                            <div class="row" style="justify-content: center;">
                              <div class="col-12 col-lg-5 ">
                                <h2>Sender Details</h2>
                                <div class="row">
                                  <label for="name">Sender Name</label>
                                  <input type="hidden" name="service_type" id="service_type" value="4087">
                                  <input type="hidden" name="title" id="title" value="DP19205">
                                  <input type="text" id="name" name="sender_name" class="form-control mb-3" placeholder="Enter Sender Name" value="<?php echo $row['fullName'] ?>" required>
                                  <label for="number">Sender Contact Number</label>
                                  <input type="text" id="number" name="sender_number" pattern="[6789][0-9]{9}" class="form-control mb-3" placeholder="Enter Sender Contact Number" value="<?php echo $row['phone'] ?>" required>
                                  <label for="email">Sender Email</label>
                                  <input type="email" id="email" name="sender_email" class="form-control mb-3" placeholder="Enter Sender Email" value="<?php echo $row['email'] ?>" required>
                                  <label for="address">Sender Full Address</label>
                                  <input type="text" id="address" name="sender_address" class="form-control mb-3" placeholder="Enter Sender Address" value="<?php echo $row['fullAddress'] ?>" required>
                                  <label for="senderPincode">Sender Pincode</label>
                                  <input type="text" id="senderPincode" name="senderPincode" class="form-control mb-3" placeholder="Enter Sender Pincode" value="<?php echo $row['pincode'] ?>" required readonly>
                                </div>
                              </div>

                              <div class="col-12 col-lg-5" style="margin-left: 10px;">
                                <h2 style="text-align:left">Receiver Details</h2>
                                <div class="row">
                                  <label for="namer">Receiver Name</label>
                                  <input type="text" id="namer" name="receiver_name" class="form-control mb-3" placeholder="Enter Receiver Name" required>
                                  <label for="numberr">Receiver Contact Number</label>
                                  <input type="text" id="numberr" name="receiver_number" pattern="[6789][0-9]{9}" class="form-control mb-3" placeholder="Enter Receiver Contact Number" required>
                                  <label for="emailr">Receiver Email</label>
                                  <input type="email" id="emailr" name="receiver_email" class="form-control mb-3" placeholder="Enter Receiver Email" required>
                                  <label for="addressr">Receiver Full Address</label>
                                  <input type="text" id="addressr" name="receiver_address" class="form-control mb-3" placeholder="Enter Receiver Address" required>
                                  <label for="receiverPincode">Receiver Pincode</label>
                                  <input type="text" id="receiverPincode" name="receiverPincode" class="form-control mb-3" placeholder="Enter Receiver Pincode" required readonly>
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
                                  <label for="insurance">Do you want to insurance your order? <em class="text-success" style="font-size: 12px;">(Insurance charges 50 or 1 % which ever is higher)</em></label>
                                </div>
                              </div>
                            </div>

                            <div class="row w-100">
                              <div class="col-12">
                                <!-- Total cost -->
                                <!-- <input type="hidden" name="amount" value="70"> -->
                                <input type="hidden" id="amount" name="price" value="0">
                                <h4>Total Cost - ₹ <span id="amounts">0</span></h4>
                              </div>
                            </div>
                            <!-- Submit button -->
                            <!-- <button data-label="Register" class="rainbow-hover mb-3" type="submit">
                          <span class="sp">Submit</span>
                        </button> -->
                            <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit" id="bookParcelBtn3">Submit Order</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  </div>
  </section>
  </div>
  <?php include("inc/footer.php") ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {

      var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

      allWells.hide();

      navListItems.click(function(e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
          $item = $(this);

        if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
        }
      });

      allNextBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
          if (!curInputs[i].validity.valid) {
            isValid = false;
            $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
        }

        if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
      });

      $('div.setup-panel div a.btn-primary').trigger('click');
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
    }

    //----------------------------------------------------------------------------------//	
    //                               Show Additional Options
    //----------------------------------------------------------------------------------//
    function showAdditionalOptions(option) {
      // Reset the price when switching between services
      document.getElementById('estimatePrice').value = "₹ 0";

      // Hide all weight/distance options by default
      // document.getElementById('superExpressDistanceOptions').style.display = 'none';
      document.getElementById('expressWeightOptions').style.display = 'none';
      document.getElementById('standardWeightOptions').style.display = 'none';
      document.getElementById('addressSection').style.display = 'none';

      // Show distance options for Super Express and weight options for others
      if (option === 'superExpress') {
        // document.getElementById('superExpressDistanceOptions').style.display = 'flex';
        document.getElementById('addressSection').style.display = 'block';
      } else if (option === 'express') {
        document.getElementById('expressWeightOptions').style.display = 'flex';
      } else if (option === 'standard') {
        document.getElementById('standardWeightOptions').style.display = 'flex';
      }

      // Show the weight/distance section
      // document.getElementById('weightSection').style.display = 'block';
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

      if (price > 0) {
        $('#bookParcelBtn2').prop('disabled', false);
      } else {
        $('#bookParcelBtn2').prop('disabled', true);
      }
    }

    // fetching pincode found or not
    $('#pickupPincode, #deliveryPincode').on('change', function() {
      var pincode = $(this).val();
      var messageElement = $(this).next('span');
      var bookParcelBtn = $('#bookParcelBtn');

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

    // pincode validation
    $('#bookParcelBtn').on('click', function(event) {
      var pickupPincode = $('#pickupPincode').val();
      var deliveryPincode = $('#deliveryPincode').val();
      var messageElement = $('#pickupPincodeMessage');
      var messageElement2 = $('#deliveryPincodeMessage');
      var bookParcelBtn = $('#bookParcelBtn');

      messageElement.text('');

      // Validate pincodes
      if (!pickupPincode) {
        messageElement.text('Pincode is required');
        messageElement.css('color', 'red');
        bookParcelBtn.prop('disabled', true);
        return;
      }
      if (!deliveryPincode) {
        messageElement2.text('Pincode is required');
        messageElement.css('color', 'red');
        bookParcelBtn.prop('disabled', true);
        return;
      }

      localStorage.setItem('pickupPincode', pickupPincode);
      localStorage.setItem('deliveryPincode', deliveryPincode);
    })

    // service validation
    $('#estimatePrice').val() == 0 ? $('#bookParcelBtn2').prop('disabled', true) : $('#bookParcelBtn2').prop('disabled', false)
    var bookParcelBtn2 = $('#bookParcelBtn2');

    $('#bookParcelBtn2').on('click', function(event) {

      var service = $('input[name="options"]:checked').val();
      var serviceMessage = $('#serviceMessage');
      var estimatePrice = $('#estimatePrice').val();

      console.log(service)
      // Validate service selection
      if (!service) {
        serviceMessage.text('Please choose a delivery service');
        // bookParcelBtn2.prop('disabled', true);
        return;
      }

      if (!estimatePrice) {
        serviceMessage.text('Please choose a delivery service');
        bookParcelBtn2.prop('disabled', true);
        return;
      }
      bookParcelBtn2.prop('disabled', false);
      localStorage.setItem('service', service);

      // Redirect to bookparcelform.php
      // window.location.href = 'bookparcelform.php';
    });

    // $('#estimatePrice').on('input', function() {
    //   var estimatePrice = $(this).val();
    //   if (estimatePrice != 0) {
    //     $('#bookParcelBtn2').prop('disabled', false);
    //   } else {
    //     $('#bookParcelBtn2').prop('disabled', true);
    //   }
    // });


    //----------------------------------------------------------------------------------//	
    //                               Autocomplete address
    //----------------------------------------------------------------------------------//
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
              suggestionsDiv.innerHTML = '';
              if (data.results && Array.isArray(data.results)) {
                data.results.forEach(item => {
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

    //----------------------------------------------------------------------------------//	
    //                               Calculate Distance
    //----------------------------------------------------------------------------------//
    function calculateDistance() {
      const address1 = document.getElementById('address1');
      const address2 = document.getElementById('address2');
      const lat1 = address1.dataset.lat;
      const lon1 = address1.dataset.lon;
      const lat2 = address2.dataset.lat;
      const lon2 = address2.dataset.lon;

      if (lat1 && lon1 && lat2 && lon2) {
        const waypoints = `${lat1},${lon1}|${lat2},${lon2}`;
        const mode = 'drive';
        const apiKey = '9da23fcd793b4acfba8f7f0100e20eea';

        fetch(`get_distance.php?waypoints=${waypoints}&mode=${mode}&apiKey=${apiKey}`)
          .then(response => response.json())
          .then(data => {
            if (data.features && data.features.length > 0) {
              const distance = data.features[0].properties.distance;
              const aDistance = Math.ceil((distance / 1000).toFixed(2));
              console.log(aDistance)
              calculatePrice(aDistance);
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

  <script>
    function updatePrice() {
      // console.log("hello")
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

    $('#bookParcelBtn2').on('click', function() {
      // Retrieve data from localStorage
      var pickupPincode = localStorage.getItem('pickupPincode');
      var deliveryPincode = localStorage.getItem('deliveryPincode');
      var serviceName = localStorage.getItem('serviceName');
      var title = localStorage.getItem('title');
      var price = parseFloat(localStorage.getItem('set_price'));
      // console.log(price)
      console.log("hello");

      // Fill in the form fields
      document.getElementById('senderPincode').value = pickupPincode;
      document.getElementById('receiverPincode').value = deliveryPincode;
      document.getElementById('service_type').value = serviceName;
      document.getElementById('title').value = title;
      document.getElementById('amount').value = price;
      document.getElementById('amounts').textContent = price;

      // Initial price update
      updatePrice();

      // Handle form submission
      $('#parcelForm').on('submit', function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
          url: 'save_order.php',
          method: 'POST',
          data: formData,
          success: function(response) {
            console.log(response)
            alert('Order saved successfully!');
            window.location.reload();
          },
          error: function() {
            alert('Error saving the order. Please try again.');
          }
        });
      });
    });
  </script>

  <!-- ./wrapper -->

</body>

</html>