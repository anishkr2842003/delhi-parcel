<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Autocomplete</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 50px auto;
            width: 300px;
        }

        #address {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        #suggestions {
            border: 1px solid #ccc;
            margin-top: 5px;
            max-height: 150px;
            overflow-y: auto;
        }

        .suggestion {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="container">
        <input type="text" id="address" placeholder="Enter address">
        <div id="suggestions"></div>
    </div>
    <!-- <script src="script.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            const addressInput = $('#address');
            const suggestionsDiv = $('#suggestions');

            addressInput.on('input', function() {
                const query = addressInput.val();
                if (query.length > 2) {
                    fetchSuggestions(query);
                } else {
                    suggestionsDiv.empty();
                }
            });

            function fetchSuggestions(query) {
                $.getJSON(`test_google.php?query=${encodeURIComponent(query)}`, function(suggestions) {
                    displaySuggestions(suggestions);
                });
            }

            function displaySuggestions(suggestions) {
                suggestionsDiv.empty();
                $.each(suggestions, function(index, suggestion) {
                    const div = $('<div></div>')
                        .addClass('suggestion')
                        .text(suggestion)
                        .on('click', function() {
                            addressInput.val(suggestion);
                            suggestionsDiv.empty();
                        });
                    suggestionsDiv.append(div);
                });
            }
        });
    </script>
</body>

</html>