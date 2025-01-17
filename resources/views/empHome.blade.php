@extends('employeelayout.default')
@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<h1>Welcome, {{ Session::get('Employee') }}</h1>
    <p>Your Role: {{ Session::get('role') }}</p>

@stop