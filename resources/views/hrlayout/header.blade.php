<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Leave Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('images/homepagepic.jpg'); /* Update the image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            color: white;
        }

        header {
            background-color: rgba(58, 63, 81, 0.8); /* Transparent background */
            padding: 20px;
            color: white;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #5a6276;
        }

        button {
            padding: 10px 20px;
            background-color: #3a3f51;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #5a6276;
        }
    </style>
</head>
<body>
    <header>
        <h1>EMPLOYEE LEAVE MANAGEMENT SYSTEM</h1>
        <nav>
            <ul>
                <li><a href="/hrHome">HR Home</a></li>
                <li><a href="/viewEmployee">View Employee</a></li>
                <li><a href="/activeEmployee">Active Employee</a></li>
                <li><a href="/inactiveEmployee">Inactive Employee</a></li>
                <li><a href="/hrchangePassword">Change Password</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <!-- Main content can go here -->

</body>
</html>
