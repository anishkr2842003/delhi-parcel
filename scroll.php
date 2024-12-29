<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scroll to Top Example</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
       
       
        #scrollTop {
            position: fixed;
            bottom: 110px;
            right: 20px;
            display: none;
            background-color: green;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
        #scrollTop:hover {
            background-color: #005f7a;
        }
        .scroll-icon {
            font-size: 24px; /* Adjust icon size */
        }

        @media screen and (max-width:768px){
            body {
            height: 2000px; /* Tall page for scrolling */
        }
        #scrollTop {
            position: fixed;
            bottom: 90px;
            right:10px;
            display: none;
            background-color: green;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
        #scrollTop:hover {
            background-color: #005f7a;
        }
        .scroll-icon {
            font-size: 24px; /* Adjust icon size */
        }
            
        }
    </style>
</head>
<body>
    <button id="scrollTop" title="Scroll to Top">
        <span class="scroll-icon">&#8679;</span> <!-- Up arrow icon -->
    </button>

    <script>
        const scrollTopButton = document.getElementById("scrollTop");

        window.onscroll = function() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollTopButton.style.display = "flex"; // Show button
            } else {
                scrollTopButton.style.display = "none"; // Hide button
            }
        };

        scrollTopButton.onclick = function() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
        };
    </script>
</body>
</html>

      
