<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Layout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }

        header img {
            width: 150px;
            margin-right: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 28px;
        }

        nav {
            background-color: #444;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            background-color: #555;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #777;
        }

        // .container {
            // margin: 20px auto;
            // padding: 20px;
            // width: 80%;
            // max-width: 1200px;
            // background-color: #fff;
            // border-radius: 10px;
            // box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        // }

        .logout-btn {
            background-color: #f00;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #900;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <img src="company_logo.png" alt="Company Logo">
        <h1>Company Name</h1>
    </header>

    <nav>
        <a href="#" onclick="loadPage('PersonalDetails.php')">Personal Details</a>
        <a href="#" onclick="loadPage('AdditionalPersonalDetails.php')">Additional Personal Details</a>
        <a href="#" onclick="loadPage('Page3.php')">Page 3</a>
        <a href="#" onclick="loadPage('Page4.php')">Page 4</a>
        <a href="#" onclick="loadPage('Page5.php')">Page 5</a>
        <button class="logout-btn">Logout</button>
    </nav>

    <div class="container" id="pageContent">
        <!-- Personal Details form will be loaded here -->
    </div>

    <footer>
        &copy; 2024 Company Name. All rights reserved.
    </footer>

    <script>
        // Load PersonalDetails.php by default
        window.onload = function() {
            loadPage('PersonalDetails.php');
        };

        function loadPage(page) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("pageContent").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", page, true);
            xhttp.send();
        }
    </script>
</body>
</html>
