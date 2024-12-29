<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Price List</title>
  <link rel="stylesheet" href="assets/CSS/style.css">
  <!-- Add Bootstrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
  <?php include("admin/config.php"); ?>

  <div class="container-fluid">
    <div class="row justify-content-center pt-5 pb-2">
      <div class="col-lg-8 col-md-8">
        <div class="sec-title">
          <h4 class="text-center"><span class="divhead"><span class="text-success">P</span><span class="text-danger">ricing </span> <span class="text-danger">R</span><span class="text-success">ates</span></span></h4>
        </div>
      </div>
    </div>
    <div class="row">

      <!--  First column -->
      <div class="col-lg-4">
        <div class="serhead">
          <h4 class="text-center  pb-2">Super Express Service</h4>
          <p class="text-center">(Delivery Within 4 Hours)</p>
        </div>
        <dl class="price-list">
          <?php
          $sql = "SELECT * FROM services WHERE `service_type` = 'Super-Express' AND status = 1";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <div class="price-item">
              <dt><?php echo $row['title']; ?></dt>
              <dd><?php echo $row['price']; ?></dd>
            </div>
          <?php } ?>
          <!-- <div class="price-item">
            <dt>1Km. to 2Km.</dt>
            <dd>80</dd>
          </div>
          <div class="price-item">
            <dt>2Km. to 3Km.</dt>
            <dd>90</dd>
          </div>
          <div class="price-item">
            <dt>3Km. to 4Km.</dt>
            <dd>155</dd>
          </div>
          <div class="price-item">
            <dt>4Km. to 5Km.</dt>
            <dd>220</dd>
          </div>
          <div class="price-item">
            <dt>5Km. to 6Km.</dt>
            <dd>320</dd>
          </div> -->
        </dl>
      </div>

      <!--  Second column -->
      <div class="col-lg-4">
        <div class="serhead">
          <h4 class="text-center  pb-2">Express Service</h4>
          <p class="text-center">(Delivery Within Same Days)</p>
        </div>
        <dl class="price-list">
          <?php
          $sql = "SELECT * FROM services WHERE `service_type` = 'Express' AND status = 1";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <div class="price-item">
              <dt><?php echo $row['title']; ?></dt>
              <dd><?php echo $row['price']; ?></dd>
            </div>
          <?php } ?>
          <!-- <div class="price-item">
            <dt>201g to 500g</dt>
            <dd>80</dd>
          </div>
          <div class="price-item">
            <dt>501g to 1kg</dt>
            <dd>90</dd>
          </div>
          <div class="price-item">
            <dt>1kg upto 2kg</dt>
            <dd>155</dd>
          </div>
          <div class="price-item">
            <dt>2kg upto 3kg</dt>
            <dd>220</dd>
          </div>
          <div class="price-item">
            <dt>3kg upto 5kg</dt>
            <dd>320</dd>
          </div> -->
        </dl>
      </div>

      <!--  Third column -->
      <div class="col-lg-4">
        <div class="serhead">
          <h4 class="text-center pb-2">Standard Service</h4>
          <p class="text-center ">(Delivery Within 2 Days)</p>
        </div>
        <dl class="price-list">
          <?php
          $sql = "SELECT * FROM services WHERE `service_type` = 'Standred' AND status = 1";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <div class="price-item">
              <dt><?php echo $row['title']; ?></dt>
              <dd><?php echo $row['price']; ?></dd>
            </div>
          <?php } ?>
          <!-- <div class="price-item">
            <dt>201g to 500g</dt>
            <dd>35</dd>
          </div>
          <div class="price-item">
            <dt>501g to 1kg</dt>
            <dd>45</dd>
          </div>
          <div class="price-item">
            <dt>1kg upto 2kg</dt>
            <dd>70</dd>
          </div>
          <div class="price-item">
            <dt>2kg upto 3kg</dt>
            <dd>100</dd>
          </div>
          <div class="price-item">
            <dt>3kg upto 5kg</dt>
            <dd>125</dd>
          </div> -->
        </dl>
      </div>


    </div>
  </div>

  <!-- Add Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>