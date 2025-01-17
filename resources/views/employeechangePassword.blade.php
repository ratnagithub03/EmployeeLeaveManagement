@extends('employeelayout.default')
@section('content')
     <p>{{Session::get('result')}}</p>
     <form method="post">
     	<input type="hidden" name="user_id" value="{{Session::get(userid)}}">
     	<label>Enter Old Password</label>
     	<input type="password" name="oldPassword">
     	<br>
     	@csrf
     	<label>Enter New Password</label>
     	<input type="password" name="oldPassword">
     	<br>
     	<label>Re-Enter Password</label>
     	<input type="password" name="rePasseord">
     	<br>
     	<input type="submit" name="btn" value="Change Password">
     </form>
     
@stop