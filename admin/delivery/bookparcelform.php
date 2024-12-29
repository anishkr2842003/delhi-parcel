<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parcel Details</title>

  <style>
    /* Basic responsive adjustments */
    @media (max-width: 768px) {
      .container {
        padding: 15px;
      }

      .row {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        /* Align left */
      }

      .col-12 {
        width: 100%;
      }

      .col-lg-5 {
        margin-left: 0;
        width: 100%;
        margin-bottom: 15px;
      }

      .col-lg-4,
      .col-lg-8 {
        width: 100%;
        margin-bottom: 15px;
      }


      /* Sender and Receiver details section adjustments */
      h2 {
        font-size: 18px;
        text-align: left;
        /* Align left */
      }

      label {
        font-size: 14px;
        text-align: left;
        /* Align labels to the left */
      }

      .form-control {
        font-size: 14px;
        width: 100%;
        /* Make input fields take full width */
      }



      /* Aligning the payment options */
      .d-flex {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        /* Align left */
      }

      .form-control {
        width: 100%;
      }

      #item_rate {
        width: 100%;
      }
    }

    /* Additional responsiveness for very small screens */
    @media (max-width: 576px) {
      h1 {
        font-size: 24px;
      }

      .form-control {
        font-size: 12px;
      }

      .col-lg-5 {
        margin-left: 0;
      }

      #amounts {
        font-size: 16px;
      }

      h4 {
        font-size: 14px;
      }

      .rainbow-hover {
        font-size: 14px;
      }

      .text-success {
        font-size: 10px;
      }
    }
  </style>
</head>

<body>

  <div class="mb-5" style="margin-top: -44px;">
    <?php include('header.php'); ?>
  </div>

  <form class="mt-5 p-2 text-center" id="parcelForm">
    <div class="container mt-5">
      <h1 class="pt-5" style="text-align:center;text-decoration: underline;">Parcel Details</h1>

      <div class="row mt-5" style="justify-content: center;">
        <div class="col-12 col-lg-5 " style="margin-left: 10px;">
          <h2>Sender Details</h2>
          <div class="row">
            <label for="name">Sender Name</label>
            <input type="hidden" name="service_type" id="service_type" value="4087">
            <input type="hidden" name="title" id="title" value="DP19205">
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
          <!-- <div id="item_rate" style="display:none">
            <input type="number" name="item_rate" placeholder="Item Rate" class="form-control" onkeyup="change_price(this.value)" id="change_item_rate">
          </div> -->
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
          <input type="hidden" id="amount" name="price" value="70">
          <h4>Total Cost - ₹ <span id="amounts">70</span></h4>
        </div>
      </div>
      <!-- Submit button -->
      <button data-label="Register" class="rainbow-hover mb-3" type="submit">
        <span class="sp">Submit</span>
      </button>

    </div>
  </form>

  <?php include('footer.php'); ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    document.addEventListener('DOMContentLoaded', function() {
      // Retrieve data from localStorage
      var pickupPincode = localStorage.getItem('pickupPincode');
      var deliveryPincode = localStorage.getItem('deliveryPincode');
      var serviceName = localStorage.getItem('serviceName');
      var title = localStorage.getItem('title');
      var price = parseFloat(localStorage.getItem('price'));

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
            // console.log(response)
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

</body>

</html>