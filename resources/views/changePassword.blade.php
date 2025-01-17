@extends('employeelayout.default')
@section('content')
<div class="password-container">
    @if(Session::get('result'))
        <div class="alert alert-success">
            {{ Session::get('result') }}
        </div>
    @endif

    <div class="card">
        <h2>Change Password</h2>
        <form method="post" action="changePassword">
            <input type="hidden" name="user_id" value="{{ Session::get('userid') }}">

            @csrf
            <div class="form-group">
                <label for="oldPassword">Old Password</label>
                <input type="password" id="oldPassword" name="oldPassword" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" id="newPassword" name="newPassword" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="rePassword"> Confirm Password</label>
                <input type="password" id="rePassword" name="rePassword" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa; /* Light background */
    }

    .password-container {
        width: 100%;
        max-width: 450px; /* Slightly reduced width */
        margin: 0 auto;
        margin-top: 0px; /* Move the form to the top */
        padding-top: 0px; /* Remove padding from the top */
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Align form closer to the top */
    }

    .card {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 100%;
    }

    h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .alert {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 4px;
        text-align: left;
    }
</style>
@stop
