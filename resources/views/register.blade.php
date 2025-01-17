@extends('layout.default')
@section('content')

<!-- Display success message if registration is successful -->
@if(Session::has('result'))
    <h3 style="color: green;">{{ Session::get('result') }}</h3>
@endif

<!-- Registration Form -->
<div class="registration-container">
    <div class="registration-box">
        <h2>REGISTRATION FORM</h2> 
        <form method="post">
            @csrf
            <div class="input-row">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name">
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email">
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                </div>
                <div class="input-group">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" placeholder="Enter your age">
                </div>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" placeholder="Enter your phone number">
                </div>
                <div class="input-group">
                    <label for="role">Role</label>
                    <select name="role" id="role">
                        <option value="" hidden>Select your role</option>
                        <option value="Hr">Hr</option>
                        <option value="Employee">Employee</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <label for="maxleave">Max Leave</label>
                <input type="number" name="maxleave" id="maxleave" placeholder="Enter max leave">
            </div>

            <div class="input-group gender-group">
                <label>Gender</label>
                <div class="radio-group">
                    <input type="radio" name="gender" id="male" value="Male">
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="female" value="Female">
                    <label for="female">Female</label>
                    <input type="radio" name="gender" id="other" value="Other">
                    <label for="other">Others</label>
                </div>
            </div>

            <input type="submit" name="btn" id="btn" value="Register">
        </form>

        <!-- Link to Go to Home Page -->
        <div style="text-align: center; margin-top: 20px;">
            <a href="/" style="color: #7f3a8d; text-decoration: underline;">Go to Home Page</a>
        </div>
    </div>
</div>

<!-- CSS Styling -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap');
    
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #7f3a8d, #bd528e, #d26d6a, #f5b4aa);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    /* Registration Form Container */
    .registration-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 0;
        width: 100%;
    }

    .registration-box {
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 500px;
        text-align: left;
        transition: transform 0.3s ease-in-out;
    }

    .registration-box:hover {
        transform: translateY(-5px);
    }

    .registration-box h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: 500;
        text-align: center;
    }

    /* Input Row for two-column layout */
    .input-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    /* Input Group */
    .input-group {
        margin-bottom: 20px;
        width: 100%;
    }

    .input-group label {
        display: block;
        color: #666;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .input-group input,
    .input-group select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
        font-size: 14px;
        box-sizing: border-box;
        transition: border 0.3s ease;
    }

    .input-group input:focus,
    .input-group select:focus {
        border-color: #7f3a8d;
        outline: none;
    }

    /* Align Gender Options Adjacent to the Label */
    .gender-group {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .gender-group label {
        margin-right: 20px;
        color: #666;
        font-size: 14px;
    }

    .radio-group {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .radio-group input[type="radio"] {
        margin-right: 5px;
    }

    .radio-group label {
        font-size: 14px;
        color: #555;
    }

    /* Submit Button */
    input[type="submit"] {
        width: 100%;
        background-color: #7f3a8d;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #5e2b6a;
    }

    /* Media Queries for Responsive Design */
    @media (max-width: 480px) {
        .input-row {
            flex-direction: column;
        }
    }
</style>

@stop
