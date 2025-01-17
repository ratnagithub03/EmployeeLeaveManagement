@extends('layout.default')
@section('content')
<h2>{{Session::get('result')}}</h2>
<form method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <br>
    @csrf
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" name="btn" id="btn" value="Login">
</form>
@stop
