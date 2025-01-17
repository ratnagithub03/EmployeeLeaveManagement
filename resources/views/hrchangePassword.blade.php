@extends('hrlayout.default')
@section('content')
    <style>
        /* General form styling */
        .password-change-form {
            max-width: 350px; /* Reduced width slightly */
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }

        .password-change-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
        }

        /* Input and labels styling */
        .password-change-form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .password-change-form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            font-family: Arial, sans-serif;
        }

        .password-change-form input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .password-change-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Success message styling */
        .password-change-form .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 15px;
        }

        /* Red asterisks */
        .password-change-form label:after {
            content: " *";
            color: red;
        }

    </style>

    <div class="password-change-form">
        <h2>Change Password</h2>

        <!-- Display success message -->
        @if(Session::get('result'))
            <div class="success-message">
                {{ Session::get('result') }}
            </div>
        @endif

        <form method="post">
            <!-- Hidden field for user ID -->
            <input type="hidden" name="user_id" value="{{ Session::get('userid') }}">

            <!-- Old Password -->
            <label for="oldPassword">Current Password</label>
            <input type="password" id="oldPassword" name="oldPassword" required>

            <!-- CSRF Protection -->
            @csrf

            <!-- New Password -->
            <label for="newPassword">Password</label>
            <input type="password" id="newPassword" name="newPassword" required>

            <!-- Confirm Password -->
            <label for="rePassword">Confirm Password</label>
            <input type="password" id="rePassword" name="rePassword" required>

            <!-- Submit Button -->
            <input type="submit" name="btn" value="Update Password">
        </form>
    </div>
@stop
