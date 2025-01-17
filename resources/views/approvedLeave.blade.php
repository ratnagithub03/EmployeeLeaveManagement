 @extends('adminlayout.default')
@section('content') 
<div id="data"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url:'api/approvedLeave',
            type:'get',
            dataType:'json',
            success:function(res){
                console.log(res);
                html = `<table border="1" width="100%" class="table table-bordered">
                <thead class="thead-dark"> <!-- Added Bootstrap class for dark header -->
                <tr>
                <th style="background-color: #007bff; color: white;">Sl.No</th> <!-- Blue header -->
                <th style="background-color: #28a745; color: white;">Name</th> <!-- Green header -->
                <th style="background-color: #ffc107; color: black;">Email</th> <!-- Yellow header -->
                <th style="background-color: #dc3545; color: white;">Phone</th> <!-- Red header -->
                <th style="background-color: #17a2b8; color: white;">Gender</th> <!-- Teal header -->
                <th style="background-color: #6c757d; color: white;">Role</th> <!-- Gray header -->
                <th style="background-color: #343a40; color: white;">Status</th> <!-- Dark header -->
                </tr>
                </thead>`;

                $(res).each(function(key, value){
                    // Add green button for 'approved' status
                    let statusButton = value.leave_status.toLowerCase() === 'approved' 
                        ? '<button style="background-color: #28a745; color: white; border: none; padding: 5px 10px; border-radius: 5px;">Approved</button>' 
                        : value.leave_status;

                    html += `<tr>
                    <td>${key+1}</td>
                    <td>${value.name}</td>
                    <td>${value.email}</td>
                    <td>${value.phone}</td>
                    <td>${value.gender}</td>
                    <td>${value.role}</td>
                    <td>${statusButton}</td>
                    </tr>`;
                });

                html += `</table>`;
                $('#data').html(html);
            }
        });
    });
</script>
@stop
