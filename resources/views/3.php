@extends('studentlayout.default')
@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<style type="text/css">
    .s{
        display: inline;
    }
    .h{
        display: none;
    }
</style>
<form enctype="multipart/form-data" id="form" method="post">
    <input type="hidden" name="user_id" id="user_id" value="{{Session::get('userid')}}">
    <label>Leave Type</label>
    <select name="leave_type" id="leave_type">
        <option hidden>Select Leave Type</option>
        <option value="cl">CL</option>
        <option value="ml">ML</option>
    </select>
    <br>
    <label>Leave Message</label>
    <textarea name="leave_message" id="leave_message"></textarea>
    <br>
    <label class="h" id="doc">Document</label>
    <input type="file" name="document" class="h" id="document">
    <br>
    <label>From Date</label>
    <input type="date" name="from_date" id="from_date">
    <br>
    <label>To Date</label>
    <input type="date" name="to_date" id="to_date">
    <br>
    <label>Days</label>
    <input type="text" name="days" id="days">
    <br>
    <input type="submit" name="btn" value="Apply Leave" id="btn">
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#leave_type').on('change',function(){
            leave_type=$('#leave_type').val();
            if(leave_type=='ml'){
                $('#doc').removeClass('h');
                $('#document').removeClass('h');
                $('#doc').addClass('s');
                $('#document').addClass('s');
            }
            else{
                $('#doc').removeClass('s');
                $('#document').removeClass('s');
                $('#doc').addClass('h');
                $('#document').addClass('h');
            }
        })
        $('#form').submit(function(){
            event.preventDefault()
            $.ajax({
                url:'/api/applyLeave',
                type:'post',
                dataType:'json',
                data:{
                    'user_id':$('#user_id').val(),
                    'leave_type':$('#leave_type').val(),
                    'leave_message':$('#leave_message').val(),
                    'from_date':$('#from_date').val(),
                    'to_date':$('#to_date').val(),
                    'days':$('#days').val()
                },
                success:function(res){
                    alert(res.message);
                }
            })
        })
        $('#to_date').change(function(){
            fromdate=$('#from_date').val();
            todate=$('#to_date').val();
            if(fromdate=='' || todate==''){
                alert('Fill the date field');
                $('#to_date').val(null);
            }else{
                const start=new Date(fromdate);
                const end=new Date(todate);
                var diff =(end-start)/(1000*60*60*24);
                days=Math.round(diff);
                $('#days').val(days);
            }
        })
    })
</script>
@stop

