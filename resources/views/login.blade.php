<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title> 
    <style>
        /* Centering the form on the page */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #7f3a8d, #bd528e, #d26d6a, #f5b4aa);
            font-family: Arial, sans-serif;
        }

        /* Styling the form container */
        form {
            background-color: rgba(255, 255, 255, 0.15);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: left;
            width: 400px;
            backdrop-filter: blur(10px);
        }

        /* Input styles */
        input[type="email"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.7);
            box-sizing: border-box;
        }

        /* Submit button styling */
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #ff512f;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #dd2476;
        }

        /* Label styles */
        label {
            color: white;
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }

        /* Checkbox and "Forgot password" link styling */
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        a {
            color: white;
            font-size: 12px;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Extra styling */
        h2 {
            color: white;
        }

        /* Styling for the welcome message */
        .welcome-message {
            color: #ffe6f0;
            text-align: center;
            font-size: 26px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Message styling */
        .message {
            text-align: center;
            font-size: 16px;
            color: white;
        }

        /* Success message in green */
        .success {
            color: green;
            font-size: 18px; /* Increased font size */
            font-weight: bold; /* Bold text */
        }

        /* Home link styling */
        .home-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>
@extends('layout.default')
@section('content')

<!-- Welcome Message -->
<div class="welcome-message">
    Hi, Welcome!
</div>

<!-- Success or Error Message (Password updated success is green) -->
@if(Session::get('message') === 'Password updated successfully')
    <h2 class="message success">{{ Session::get('message') }}</h2>
@else
    <h2 class="message">{{ Session::get('message') }}</h2>
@endif

<!-- Login Form -->
<form method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    @csrf
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    
    <!-- Remember Me and Forgot Password -->
    <div class="options">
        <label><input type="checkbox" name="remember"> Remember me</label>
        <a href="/forgotPassword">Forgot Password?</a>
    </div>

    <input type="submit" name="btn" id="btn" value="Login">

    <!-- Link to go to Home Page -->
    <a href="/" class="home-link">Go to Home Page</a>
</form>

@stop
</body>
</html>
