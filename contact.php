<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.png">
  <title>Delhi-Parcel</title>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/CSS/style.css">

</head>

<body>

  <?php include('header.php'); ?>


  <div class="container-fluid pt-5">

    <section class="services-sec mt-5 pt-5">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-8">
            <div class="sec-title">
              <h2><span>Contact Us</span></h2>
              <br>
              <img src="assets/images/logo.png" class="whychoose">
              <p class="text-center">We are the fastest growing express logistics service provider in India</p>
            </div>
          </div>
        </div>
      </div>
    </section>



    <div class="container contact-form-container">
      <h2 class="text-center contact-form-title mb-4">Contact Form</h2>

      <form id="contactForm">
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="mb-3">
              <label for="fullName" class="form-label">Full Name</label>
              <input type="text" class="form-control contact-form-input" id="fullName" name="fullName" placeholder="Enter your name">
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control contact-form-input" id="email" name="email" placeholder="Enter your email">
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control contact-form-input" id="phone" name="phone" placeholder="Enter your phone number">
            </div>

            <div class="mb-3">
              <label for="category" class="form-label">Select Categories</label>
              <select class="form-select contact-form-select" id="category" name="category">
                <option selected disabled>Choose...</option>
                <?php
                include("admin/config.php");
                $sql = "SELECT * FROM categories WHERE status = 1";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
                <?php } ?>
                <!-- <option value="sales">Scout & NCC</option>
                <option value="feedback">Fancy Dress</option>
                <option value="other">Inner Ware</option>
                <option value="support">Sport Items</option>
                <option value="sales">School Items</option>
                <option value="feedback">Grocceries</option>
                <option value="other">Electronic Items</option> -->
              </select>
            </div>
          </div>

          <div class="col-12 col-lg-6">
            <div class="mb-3">
              <label for="fullAddress" class="form-label">Full Address</label>
              <input type="text" class="form-control contact-form-input" id="fullAddress" name="fullAddress" placeholder="Enter your name" >
            </div>

            <div class="mb-3">
              <label for="itemsCount" class="form-label">No.Of Items</label>
              <input type="number" class="form-control contact-form-input" id="itemsCount" name="itemsCount" placeholder="Enter your email" >
            </div>

            <div class="mb-3">
              <label for="panNo" class="form-label">Gst or Pan Card No.</label>
              <input type="text" class="form-control contact-form-input" id="panNo" name="panNo" placeholder="Enter your phone number" >
            </div>

            <div class="mb-3">
              <div class="contact-form-group">
                <input type="file" class="form-input" id="panImage" name="panImage" title="GST Or Pan Card *" autocomplete="off">
              </div>
            </div>

          </div>
        </div>

        <div class="mb-3 text-center ">
          <textarea class="form-control contact-form-textarea w-100" id="contactMessage" name="contactMessage" rows="4" placeholder="Type your message here"></textarea>
          <button data-label="Register" class="rainbow-hover text-center mt-2">
            <span class="sp">Submit</span>
          </button>
        </div>

      </form>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-8 ">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111989.16561106232!2d77.12046146392828!3d28.699772976417194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfc159ee686d5%3A0x634bded521417dfb!2sDelhi%20Parcel!5e0!3m2!1sen!2sin!4v1730961959098!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>

        <div class=" col-12 col-lg-4 address">
          <h2>Address :</h2>
          <p>B-14/100, Street no - 11, Subhash vihar New Delhi North East, delhi, 110053</p>
          <p>call us: 7678149050</p>
          <p>Mail : info@delhiparcel.com</p>
        </div>
      </div>
    </div>

    <!-- <button onclick="abc()">Heloo</button> -->


  </div>

  <?php include('footer.php'); ?>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
  <script src="admin/super-admin/toast.js"></script>
  <!-- <script>
    function abc() {
      Toast('success', "Hello")
    }
  </script> -->
  <script>
    $(document).ready(function() {

      // add inquiry 
      $('#contactForm').on('submit', function(event) {
        event.preventDefault();

        // Front-end validation
        var fullName = $('#fullName').val()
        var email = $('#email').val()
        var phone = $('#phone').val()
        var category = $('#category').val()
        var fullAddress = $('#fullAddress').val()
        var itemsCount = $('#itemsCount').val()
        var panNo = $('#panNo').val()
        var panImage = $('#panImage').val()
        var contactMessage = $('#contactMessage').val()

        if (!fullName) {
          Toast("error", "Name is required");
          return;
        }
        if (!email) {
          Toast("error", "email is required");
          return;
        }
        if (!phone) {
          Toast("error", "phone is required");
          return;
        }
        if (!category) {
          Toast("error", "category is required");
          return;
        }
        if (!fullAddress) {
          Toast("error", "Address is required");
          return;
        }
        if (!itemsCount) {
          Toast("error", "Items Count is required");
          return;
        }
        if (!panNo) {
          Toast("error", "Pan no or GST no is required");
          return;
        }
        if (!panImage) {
          Toast("error", "Image is required");
          return;
        }
        if (!contactMessage) {
          Toast("error", "Message is required");
          return;
        }

        var formData = new FormData(this);
        formData.append('action', 'addInquiry');

        $.ajax({
          url: 'admin/super-admin/query.php',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(response) {
            console.log(response);
            const data = typeof response === 'string' ? JSON.parse(response) : response;
            console.log(data);
            if (data.status === 'success') {
              Toast('success', response.message);
              $('#contactForm')[0].reset();
            } else {
              Toast('error', response.message)
            }
          },
          error: function(error) {
            console.log(error)
            Toast('error', 'An error occurred. Please try again.')
            // alert('An error occurred. Please try again.');
          }
        });
      });

    });
  </script>
</body>

</html>