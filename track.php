

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.png">
    <title>Delhi-Parcel</title>

    <style>

p{
    font-size: 1.5rem;
}
.container-fluid{
    background-image:url(assets/images/bgm.png);
    background-repeat: no-repeat;
    background-size: cover;
 }


        .body1{
    display: flex;
    justify-content: center;
    align-items: center;
    scroll-behavior: smooth;
    padding-bottom: 20px;
  }
  .tracking-container {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    width: 100%;
    margin-top: 30px;
    max-width: 400px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .logo {
    display: block;
    margin: 0 auto 10px;
    width: 60%;
    max-width: 200px;
  }
  
  .tracking-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  
  .radio-group {
    display: flex;
    gap: 10px;
    align-items: center;
  }
  
  textarea {
    width: 100%;
    padding: 10px;
    resize: none;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 12px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
  }
  
  button:hover {
    background-color: #45a049;
  }
  
  small {
    font-size: 12px;
    color: #666;
  }
  
  .how-to-track {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #007bff;
    text-decoration: none;
  }
  
  .how-to-track:hover {
    text-decoration: underline;
  }

  .whychoose{
  height: 80px;
}
  
  /* Responsive adjustments */
  @media (max-width: 480px) {
    .tracking-container {
      padding: 15px;
    }
  
    textarea {
      font-size: 14px;
    }
  
    button {
      font-size: 14px;
    }
  }
    </style>
</head>
<body>
    
<?php include ('header.php'); ?>

<div class="container-fluid pt-5">
    <section class="services-sec mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 pt-5">
                    <div class="sec-title">
                        <h2><span>Track Your Parcel</span></h2><br>
                        <img src="assets/images/logo.png" class="whychoose">
                    </div>
                </div>
            </div>

              
<div class="body1">


<div class="tracking-container">
  <img src="https://thumbs.dreamstime.com/b/tracking-icon-trendy-logo-concept-white-background-technology-collection-suitable-use-web-apps-mobile-print-media-250744918.jpg" alt="TrackDart Logo" class="logo">

  <form class="tracking-form">
    <div class="radio-group">
      <input type="radio" id="waybill" name="trackingType" value="waybill">
      <label for="waybill">Order Id</label>
      <input type="radio" id="refNo" name="trackingType" value="refNo" checked>
      <label for="refNo">Mobile Number</label>
    </div>

    <textarea placeholder="Enter your Order Id / Mobile No."></textarea>
    <small>For multiple queries use commas (,): e.g., 79034111122, 79034111041</small>

    <button type="submit">GO</button>
  </form>
</div>
</div>

            </div>
        </div>
    


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include ('footer.php'); ?>
</body>
</html>
