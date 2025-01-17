@extends('adminlayout.default')
@section('content')

<div class="password-change-container">
    @if(Session::has('result'))
    <div class="alert alert-success">
        {{Session::get('result')}}
    </div>
    @endif

    <h2>Change Password</h2>

    <form method="post" action="changePassword" class="password-form">
        @csrf
        <input type="hidden" name="user_id" value="{{Session::get('userid')}}">

        <div class="form-group">
            <label for="oldPassword"> Old Password</label>
            <input type="password" name="oldPassword" id="oldPassword" required>
        </div>
        <div class="form-group">
            <label for="newPassword">New Password</label>
            <input type="password" name="newPassword" id="newPassword" required>
        </div>

        <div class="form-group">
            <label for="rePassword"> Confirm Password</label>
            <input type="password" name="rePassword" id="rePassword" required>
        </div>

        <div class="form-group">
            <input type="submit" name="btn" value="Update Password" class="btn btn-primary">
        </div>
    </form>
</div>

<!-- Embedded CSS -->
<style>
.password-change-container {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
}

.alert {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    margin-bottom: 15px;
    text-align: center;
}

h2 {
    text-align: center;
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

input[type="password"] {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ced4da;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    margin-top: 10px;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}
</style>



</script>

@stop
