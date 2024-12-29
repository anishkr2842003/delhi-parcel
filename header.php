<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.png">
    <title>Delhi-Parcel</title>
   
</head>
<body>
    <div class="container1">
        <marquee>Delhi parcel is dedicated to providing reliable and efficient courier services to businesses and individuals alike.</marquee>
        <div  id="header">
           <a href="index.php"> <img class="logo" src="assets/images/logo.png" alt="Logo"></a>
            <nav>
                
                <ul class="nav-links" id="navLinks">
                    <li><a href="index.php">Home</a></li>
                    <!-- <li><a href="about.php">About</a></li> -->
                    <li><a href="bookparcel.php">Book Parcel</a></li>
                    <li><a href="track.php">Track Order</a></li>
                    <li>
                        <a href="services.php">Services</a>
                        <div class="sub-dropdown">
                        <ul>
                                <li><a href="services.php"><span>All Services</span></a></li>
                                <li><a href="services.php">Express Service</a></li>
                                <li><a href="services.php">Standard Service</a></li>
                                <li><a href="services.php">Super Express Service</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="contact.php" style="color:#FF5D01;">Business Enquiry</a></li>
                </ul>
       
            </nav>
            
            <div class="auth-buttons">
            <button data-label="Register" class="rainbow-hover">
  <span class="sp">Register</span>
</button>
                <div class="hamburger" id="hamburger">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        
        <div class="dropdown" id="dropdownMenu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <!-- <li><a href="about.php">About</a></li> -->
                <li><a href="bookparcel.php">Book Parcel</a></li>
                <li><a href="track.php">Track Order</a></li>
                <li>
                   <a> Services</a>
                    <div class="sub-dropdown">
                    <ul>
                                <li><a href="services.php">All Services</a></li>
                                <li><a href="services.php">Express Service</a></li>
                                <li><a href="services.php">Standard Service</a></li>
                                <li><a href="services.php">Super Express Service</a></li>
                            </ul>
                    </div>
                </li>
                
                <li><a href="contact.php" style="color:#FF5D01;">Business Enquiry</a></li>
            </ul>
        </div>
        
    </div>

    <script>
        const header = document.getElementById('header');
        const hamburger = document.getElementById('hamburger');
        const dropdownMenu = document.getElementById('dropdownMenu');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 0) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        hamburger.addEventListener('click', () => {
            dropdownMenu.classList.toggle('dropdown-active');
        });

        window.addEventListener('click', (event) => {
            if (!event.target.closest('nav') && !event.target.closest('#hamburger')) {
                dropdownMenu.classList.remove('dropdown-active');
                const subDropdowns = document.querySelectorAll('.sub-dropdown');
                subDropdowns.forEach(subDropdown => {
                    subDropdown.classList.remove('sub-dropdown-active');
                });
            }
        });

        document.querySelectorAll('#dropdownMenu > ul > li').forEach(item => {
            item.addEventListener('click', (event) => {
                const subDropdown = item.querySelector('.sub-dropdown');
                if (subDropdown) {
                    subDropdown.classList.toggle('sub-dropdown-active');
                    event.stopPropagation();
                }
            });
        });
    </script>
</body>
</html>
