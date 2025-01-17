@extends('layout.default')
@section('content')

<!-- <h3>{{Session::get('result')}}</h3> -->

<form action="post">
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <br>
    <label for="Password">Password</label>
    <input type="password" name="password" id="password">
    <br>
    <label for="age">Age</label>
    <input type="text" name="age" id="age">
    <br>
    <label for="phone">Phone</label>
    <input type="text" name="phone" id="phone">
    <br>
    <label for="role">Role</label>
    <input type="role" name="role" id="role">
    <br>
    <select name="role" id="role">
        <option value="" hidden>Select Your role</option>
        <option value="HR" >Select Your role</option>
        <option value="EMPLOYEE" >Select Your role</option>
</select>
<br>
<label for="maxleave">MaxLeave</label>
<input type="text" name="maxleave" id="maxleave">
<br>
<label for="gender">Gender</label>
<input type="radio" name="gender" id="gender" value="male">Male
<input type="radio" name="gender" id="gender" value="female">Female
<input type="radio" name="gender" id="gender" value="male">Others
<br>
<input type="submit" name="btn" value="Register">
</form>
@stop